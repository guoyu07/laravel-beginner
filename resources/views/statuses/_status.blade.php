<li id="status-{{ $status->id }}">
    <a href="{{ route('users.show', $status->user->id) }}">
        <img src="{{ $status->user->gravatar() }}" alt="{{ $status->user->name }}" class="gravatar" />
    </a>

    <span class="user">
        <a href="{{ route('users.show', $status->user->id) }}">{{ $status->user->name }}</a>
    </span>

    <span class="timestamp">
        {{ $status->created_at->diffForHumans() }}
    </span>

    <span class="content">
        {{ $status->content }}
    </span>

    @can('destroy', $status)
        <form action="{{ route('statuses.destroy', $status) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}

            <button class="btn btn-danger btn-sm status-delete-btn">删除</button>
        </form>
    @endcan
</li>