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

                    @can ('destroy', $user)
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type='submit' class="btn btn-danger btn-sm delete-btn">删除</button>
                        </form>
                    @endCan
                </li>
            @endForeach
        </ul>

        {{--  {{ $users->links() }}  --}}
        {{ $users->render() }}
    </div>
@endSection