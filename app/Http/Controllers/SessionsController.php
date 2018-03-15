<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use Auth;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', [
            'only' => ['create'],
        ]);
    }

    /**
     * 显示登录页面
     *
     * @return void
     */
    public function create()
    {
        return view('sessions.create');
    }

    /**
     * 登录时创建新会话
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);
        
        if (Auth::attempt($credentials, $request->has('remember'))) {
            session()->flash('success', '欢迎回来！');
            
            // 未登录用户进入编辑页面，会跳转到登录页面；再次登录依旧会进入个人信息页面
            // 使用　redirect()->intended() 方法可记住用户上次访问地址，登录成功可跳转至
            // 上次访问的地址

            // return redirect()->route('users.show', [Auth::user()]);
            return redirect()->intended(route('users.show', [Auth::user()]));
        } else {
            session()->flash('danger', '很抱歉，您的邮箱和密码不匹配');
            return redirect()->back()->withInput();
        }
    }

    /**
     * 销毁用户会话
     *
     * @param User $user
     * @return void
     */
    public function destory(User $user)
    {
        Auth::logout();
        session()->flash('success', '您已成功退出！');
        return redirect('login');
    }
}
