<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Status;
use Auth;
use Mail;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['index', 'create', 'show', 'store', 'confirmEmail']
        ]);
    }

    public function index()
    {
        $users = User::paginate(15);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $title = '注册';

        return view('users.create', compact('title'));
    }

    public function show(User $user)
    {
        // $statuses = $user->statuses()->orderBy('created_at', 'desc')->paginate(15);
        $statuses = $user->feed()->paginate(15);
        $title = '用户信息';

        return view('users.show', compact(['title','user', 'statuses']));
    }

    public function store(Request $request)
    {
        $validate = $this->validate($request, [
            'name' => 'required|min:6|max:50',
            'email' => 'required|email|unique:users|min:6',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $this->sendEmailConfirmTo($user);
        session()->flash('success', '验证邮件已发送到你的注册邮箱上，请注意查收。');
        return redirect()->route('home');
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required|min:6|max:50',
            'password' => 'required|confirmed|min:6',
        ]);

        $user->update([
            'name' => $request->name,
            'password'=> bcrypt($request->password),
        ]);

        session()->flash('success', '个人信息更新成功！');
        return redirect()->route('users.show', $user);
    }

    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
        $user->delete();
        session()->flash('success', '成功删除用户！');
        return redirect()->back();
    }

    public function confirmEmail($token)
    {
        $user = User::where('activation_token', $token)->firstOrFail();

        $user->activated = true;
        $user->activation_token = null;
        $user->save();

        Auth::login($user);
        session()->flash('success', '恭喜您，激活成功！');
        return redirect()->route('users.show', [$user]);
    }

    private function sendEmailConfirmTo(User $user)
    {
        $view = 'emails.confirm';
        $from = 'huliuqing@126.com';
        $name = 'huliuqing';
        $to = $user->email;
        $data = compact('user');
        $subject = "感谢注册 Sample 应用！请确认你的邮箱。";

        Mail::send($view, $data, function ($message) use ($from, $name, $to, $subject) {
            $message->from($from, $name)->to($to)->subject($subject);
        });

    }

    public function followings(User $user)
    {
        $users = $user->followings()->paginate(15);
        $title= '关注列表';

        return view('users.show_follower', compact('title', 'users'));
    }

    public function followers(User $user)
    {
        $users = $user->followers()->paginate(15);
        $title= '粉丝列表';

        return view('users.show_follower', compact('title', 'users'));
    }
}
