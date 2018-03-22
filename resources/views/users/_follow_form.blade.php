@if ($user->id != Auth::user()->id)
    <div id="follow-form">
        @if (Auth::user()->isFollowing($user->id))
            <form action="{{ route('followers.destroy', $user->id) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE')}}
                <button class="btn btn-sm">取消关注</button>
            </form>
        @else
            <form action="{{ route('followers.store', $user->id) }}" method="POST">
                {{ csrf_field() }}
                <button class="btn btn-sm btn-primary">关注</button>
            </form>

        @endIf
    </div>
@endIf