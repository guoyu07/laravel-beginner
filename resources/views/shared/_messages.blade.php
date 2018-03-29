@foreach (['success', 'info', 'danger', 'warning'] as $level)
    @if (session()->has($level))
        <div class="flash-message">
            <p class="alert alert-{{ $level }}">
                {{ session()->get($level) }}
            </p>
        </div>
    @endif
@endforeach