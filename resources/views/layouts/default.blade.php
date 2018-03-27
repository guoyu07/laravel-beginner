<!DOCTYPE html>
<<<<<<< HEAD
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', config('app.name')) - Laravel 学习项目</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    @include('layouts._header')

    <div class="container">
        @yield('content')
        @include('layouts._footer')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
=======
<html>
    <head>
        <title>@yield('title', 'PHP Artisan') - Laravel 入门</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/laravel-beginner/public/css/app.css">
    </head>
    <body>
        @include('layouts/_header')

        <div class="container">
            <div class="col-md-offset-1 col-md-10">
                @include('shared._message')
                @yield('content')
                @include('layouts/_footer')
            </div>
        </div>

        <script src="/laravel-beginner/public/js/app.js"></script>
    </body>
>>>>>>> master-clone
</html>