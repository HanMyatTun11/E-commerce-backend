<div class="container">
    <div class="col-md-8 offeset-md-2">
        @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{Session::get('error')}}</strong> You should check in on some of those fields below.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{Session::get('success')}}</strong> You should check in on some of those fields below.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
</div>


