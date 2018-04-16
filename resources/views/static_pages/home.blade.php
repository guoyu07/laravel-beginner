@extends('layouts.default')

@section('title', $title)

@section('content')
@if (Auth::check())
    <div class="row">
        <div class="col-md-8">
            <section class="status_form">
                @include('shared._status_form')
            </section>

            <h3>动态</h3>
            @include('shared._feed')
        </div>

        <aside class="col-md-4">
            <section class="user_info">
                @include('shared._user_info', ['user' => Auth::user()])
            </section>

            <section class="stats">
                @include('shared._stats', ['user' => Auth::user()])
            </section>
        </aside>
    </div>
@else    
    <div class="jumbotron">
        <h1>Hello Laravel</h1>
        <p class="lead">
            学习 <a href="https://laravel-china.org/courses/laravel-essential-training-5.1">Laravel 入门教程</a>
        </p>
        <p>打开 Laravel  的大门</p>
        <p>
            <a href="{{ route('signup') }}" class="btn btn-lg btn-success" role="botton">立即注册</a>
        </p>
    </div>
@endif
@endSection