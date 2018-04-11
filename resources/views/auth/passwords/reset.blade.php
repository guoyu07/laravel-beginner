@extends('layouts.default')

@section('title', '更新密码')
    
@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">更新密码</div>
            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                
                <form class="form-horizontal"  action="{{ route('password.update') }}" method="post">
                    {{ csrf_field() }}

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group {{ $errors->has('') ? ' has-error' : ''}}">
                        <label for="email" class="control-label col-md-4">邮箱：</label>
                        <div class="col-md-6">
                            <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('password') ? ' has-error' : ''}}">
                        <label for="password" class="control-label col-md-4">密码：</label>
                        <div class="col-md-6">
                            <input type="password" name="password" class="form-control">
                            @if ($errors->has('password'))
                                <span class="help-block">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : ''}}">
                        <label for="password_confirmation" class="control-label col-md-4">确认密码：</label>
                        <div class="col-md-6">
                            <input type="password" name="password_confirmation" class="form-control">
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                修改密码
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
