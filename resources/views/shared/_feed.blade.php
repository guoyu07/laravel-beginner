@if (count($feeds))
<ol class="statuses">
    @foreach ($feeds as $status)
        @include('statuses._status', ['user' => $status->user])
    @endForeach
    {{ $feeds->render() }}
</ol>
@endIf