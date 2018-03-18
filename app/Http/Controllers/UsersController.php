<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use Auth;
use Mail;

class UsersController extends Controller
{
    public function __construct()
    {
        // 启用 auth 中间件，未登录用户仅能访问 show, create,和 store 路由
        // 中间件 @see https://laravel-china.org/docs/laravel/5.5/middleware
        $this->middleware('auth', [
            'except' => ['show', 'create', 'store', 'index', 'confirmEmail'],
        ]);

        // guest 中间件
        $this->middleware('guest', [
            'only' => ['create'],
        ]);
    }

    /**
     * 显示用户信息列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(15);
        return view('users.index', compact('users'));
    }

    /**
     * 创建用户表单页面
     *
     * @return void
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * 创建用户处理
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * @see https://laravel-china.org/index.php/docs/laravel/5.6/validation
         */
        $validate = $this->validate($request, [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6',
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        
        
        $this->sendEmailConfirmTo($user);

        /******************************************/
        /*    自动登录用户，修改为发送激活邮件服务   */
        /******************************************/
        //  Illuminate\Auth\SessionGuard.php 
        // Auth::login($user);
        // /**
        //  * 会话
        //  * @see https://laravel-china.org/index.php/docs/laravel/5.6/session
        //  */
        // session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');
        // return redirect()->route('users.show', [$user]);

        $this->sendEmailConfirmTo($user);
        session()->flash('success', '验证邮件已发送到你的注册邮箱上，请注意查收。');

        return redirect()->route('home');
    }

    /**
     * 显示给定的用户信息
     *
     * @param App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * 显示用户编辑表单
     *
     * @param App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    /**
     * Undocumented function
     *
     * @param \Illuminate\Http\Request $request
     * @param App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $credentials = $this->validate($request, [
            'name' => 'required|min:3|max:50',
            'password' => 'nullable|confirmed|min:6'
        ]);

        // $user->update([
        //     'name' => $request->name,
        //     'password' => bcrypt($request->password),
        // ]);
        
        $data['name'] = $request->name;

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        session()->flash('success', '更新成功!');
        return redirect()->route('users.show', $user->id);
    }

    /**
     * 删除给定用户
     *
     * @param App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
        $user->delete();

        session()->flash('success', '成功删除用户!');
        return redirect()->back();
    }

    public function confirmEmail($token)
    {
        $user = User::where('activation_token', $token)->firstOrFail();
        $user->activation_token = null;
        $user->activated = true;
        $user->save();

        Auth::login($user);
        session()->flash('success', '恭喜你，激活成功！');

        return redirect()->route('users.show', compact('user'));
    }

    protected function sendEmailConfirmTo($user)
    {
        $view = 'emails.confirm';
        $data = compact('user');
        $from = config('mail.from.address');
        $name = config('mail.from.name');
        $to = $user->email;
        $subject = sprintf("感谢注册 %s 应用！请确认你的邮箱。", config("app.name"));
        
        Mail::send($view, $data, function($message) use ($from, $name, $to, $subject) {
            $message->from($from, $name)->to($to)->subject($subject);
        });
    }
}
