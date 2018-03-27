<form action="{{ route('statuses.store') }}" method="POST">
    @include('shared._error')
    {{ csrf_field() }}
    <textarea name="content" id="content" class="form-control" rows="3" placeholder="聊聊新鲜事儿...">{{ old('content') }}</textarea>
    <button class="btn btn-primary pull-right" type="submit">发布</button>
</form>