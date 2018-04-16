<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class StaticPagesController extends Controller
{
    public function home()
    {
        $title = '主页';
        $feeds = [];
        if ( Auth::check() ) {
            $feeds = Auth::user()->feed()->paginate(15);
        }

        return view('static_pages/home', compact('title', 'feeds'));
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
