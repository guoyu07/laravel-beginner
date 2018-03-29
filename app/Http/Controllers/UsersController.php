<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UsersController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function create()
    {
        $title = '注册';

        return view('users.create', compact('title'));
    }

    public function show(User $user)
    {
        $user->gravatar();
        $title = '用户信息';
        return view('users.show', compact(['title','user']));
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
        
        if ($user) {
            Auth::login($user);
            session()->flash('success', '恭喜您，注册成功！');
        } else {

        }
        
        return redirect()->route('users.show', ['user' => Auth::user()]);
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        return redirect()->back();
    }

    public function destroy(User $user)
    {
        return redirect()->back();
    }
}
