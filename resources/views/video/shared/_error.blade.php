@if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      @foreach ($errors->all() as $error)
        <li><i class="glyphicon glyphicon-remove"></i> {{ $error }}</li>
      @endforeach
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
@endif
