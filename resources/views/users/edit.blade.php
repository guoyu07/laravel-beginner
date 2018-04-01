@extends('layouts.default')

@section('title', '编辑个人信息')

@section('content')
    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default">
            <div class="panel panel-heading">
                <h5>编辑个人信息</h5>
            </div>
            <div class="panel panel-body">
                @include('shared._errors')

                <div class="gravatar_edit">
                    <a href="" target="_black">
                        <img src="{{ $user->gravatar() }}" alt="{{ $user->name }}" class="gravatar">
                    </a>
                </div>

                <form action="{{ route('users.update', $user->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <div class="form-group">
                        <label for="name">用户名：</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                    </div>

                    <div class="form-group">
                        <label for="email">邮箱：</label>
                        <input type="text" name="email"  class="form-control" value="{{ $user->email }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="password">密码：</label>
                        <input type="text" name="password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">确认密码：</label>
                        <input type="text" name="password_confirmation" class="form-control">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">更新</button>
                </form>
            </div>
        </div>
    </div>
    
@endsection