@extends('layouts.default')

@section('title', $title)

@section('content')
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
@endSection