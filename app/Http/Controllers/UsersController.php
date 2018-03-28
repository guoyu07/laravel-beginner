<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
        return redirect()->back();
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
