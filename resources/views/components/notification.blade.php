@if (session('msg'))
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <strong>{{session('msg')}}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif