@if (count($feeds))
    <ol class="statuses">
        @foreach ($feeds as $status)
            @include('statuses._status', ['user' => $status->user])
        @endforeach
        {{ $feeds->render() }}
    </ol>
@endif