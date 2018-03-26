<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function create()
    {
        $title = '注册';

        return view('users.create', compact('title'));
    }
}
