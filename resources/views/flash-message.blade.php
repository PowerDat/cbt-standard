@if ($message = Session::get('success'))
<div class="alert alert-primary dark alert-dismissible fade show" role="alert">
    <strong><i data-feather="alert-circle"></i> {{ $message }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if ($message = Session::get('info'))
<div class="alert alert-light dark alert-dismissible fade show" role="alert">
    <strong><i data-feather="alert-circle"></i> {{ $message }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

