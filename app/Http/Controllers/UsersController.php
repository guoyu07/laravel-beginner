<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;

class UsersController extends Controller
{
    /**
     * 显示用户信息列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index');
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
            'password' => bcrypt($request->email),
        ]);

        /**
         * 会话
         * @see https://laravel-china.org/index.php/docs/laravel/5.6/session
         */
        session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');
        return redirect()->route('users.show', [$user]);
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

    }

    /**
     * 删除给定用户
     *
     * @param App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destory(User $user)
    {

    }
}
