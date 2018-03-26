<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    public function home()
    {
        $title = '主页';
        return view('static_pages/home', compact('title'));
    }
    
    public function help()
    {
        $title = '帮助';
        return view('static_pages/help', compact('title')); 
    }
    
    public function about()
    {
        $title = '关于';
        return view('static_pages/about', compact('title'));
    }
}
