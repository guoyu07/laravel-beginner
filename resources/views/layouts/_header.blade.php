<<<<<<< HEAD
    <header class="navbar navbar-fixed-top navbar-inverse">
        <div class="container">
            <div class="col-md-offset-1 col-md-10">
                <a href="/" class="logo">Laravel 学习项目</a>

                <nav>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ route('help') }}">帮助</a></li>
                        <li><a href="#">登录</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
=======
<header class="navbar navbar-fixed-top navbar-inverse">
    <div class="col-md-offset-1 col-md-10">
        <a href="/laravel-beginner/public" id="logo">PHP Artisan</a>
        <nav>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                    <li><a href="{{ route('users.index') }}">用户列表</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true">
                            {{ Auth::user()->name }} <b class="caret"></b>
                        </a>
                        
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('users.show', ['id' => Auth::user()->id]) }}">个人中心</a></li>
                            <li><a href="{{ route('users.edit', ['id' => Auth::user()->id]) }}">编辑信息</a></li>
                            <li class="divider"></li>
                            <li>
                                <a href="#" id="logout">
                                    <form action="{{ route('logout') }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" name="button" class="btn btn-block btn-danger">退出</button>
                                    </form>
                                </a>
                            </li>
                        </ul>
                    </li>
                @else
                    <li><a href="{{ route('help') }}">帮助</a></li>
                    <li><a href="{{ route('login') }}">登录</a></li>
                @endIf
            </ul>
        </nav>
    </div>
</header>
>>>>>>> master-clone
