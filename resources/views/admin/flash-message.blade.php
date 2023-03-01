<div class="flash-message">
    @foreach (['success', 'danger', 'warning', 'info', 'primary', 'secondary', 'dark'] as $msg)
    @if(Session::has($msg))
    <div class="alert alert-{{ $msg }}">{{ Session::get($msg) }}</div>
    @endif
    @endforeach
</div>