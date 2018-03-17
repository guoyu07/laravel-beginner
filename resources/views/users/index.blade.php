@extends('layouts/default')

@section('title', '用户列表')

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <h1>用户列表</h1>
        
        <ul class="users">
            @foreach ($users as $user)
                <li>
                    <img src="{{ $user->gravatar() }}" alt="{{ $user->name }}" class="gravatar">
                    <a href="{{ route('users.show', $user->id) }}" class="username">{{ $user->name }}</a>
                </li>
            @endForeach
        </ul>

        {{--  {{ $users->links() }}  --}}
        {{ $users->render() }}
    </div>
@endSection