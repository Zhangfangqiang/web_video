@foreach (['danger', 'warning', 'success', 'info'] as $msg)
  @if(session()->has($msg))
    <div class="alert alert-{{ $msg }} alert-dismissible fade show" role="alert">
        {{ session()->get($msg) }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif
@endforeach
