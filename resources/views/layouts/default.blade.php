<!DOCTYPE html>
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
</html>