<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['index', 'create', 'show', 'store']
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
}
