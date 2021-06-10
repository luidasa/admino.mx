@if (session('alert-primary') !== null)
    <div class="alert alert-primary" role="alert">
        {{session('alert-primary')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if (session('alert-secondary') !== null)
    <div class="alert alert-secondary" role="alert">
        {{session('alert-secondary')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if (session('alert-success') !== null)
    <div class="alert alert-success" role="alert">
        {{session('alert-success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if (session('alert-danger') !== null)
    <div class="alert alert-danger" role="alert">
        {{session('alert-danger')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if (session('alert-warning') !== null)
    <div class="alert alert-warning" role="alert">
        {{session('alert-warning')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if (session('alert-info') !== null)
    <div class="alert alert-info" role="alert">
        {{session('alert-info')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if (session('alert-light') !== null)
    <div class="alert alert-light" role="alert">
        {{session('alert-light')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if (session('alert-dark'))
    <div class="alert alert-dark" role="alert">
        {{session('alert-dark')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
