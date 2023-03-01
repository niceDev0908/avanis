@foreach (['success', 'danger', 'warning', 'info', 'primary', 'secondary', 'dark'] as $msg)
@if(Session::has($msg))
<div class="alert alert-{{ $msg }} alert-dismissible fade show mb-3" role="alert">
    {{ Session::get($msg) }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@endforeach
