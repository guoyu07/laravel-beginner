@extends('layouts/default')

@section('title', '首页')

@section('content')
    <h1>首页</h1>
    @if (Auth::check())
        <div class="rol">
            <div class="col-md-8">
                <section class="status-form">
                    @include('shared._status_form')
                </section>
                <h3>动态</h3>
                @include('shared._feed')
            </div>
            <aside class="col-md-4">
                <section class="user-info">
                    @include('shared._user_info', ['user' => Auth::user()])
                </section>
            </aside>
        </div>
    @else
        <div class="jumbotron">
            <h1>Hello Laravel</h1>
            <p>
                这是 <a href="https://laravel-china.org/courses/laravel-essential-training-5.1">Laravel 入门教程</a> 的 Home 页面
            </p>

            <p>
                一切从这里开始
            </p>

            <p>
                <a href="{{ route('signup') }}" role=button class="btn btn-lg btn-success">现在注册</a>
            </p>
        </div>
    @endIf
@endSection