<div>

    @if ($errors->has('general'))
        <div class="alert alert-danger alert-dismissible fade show mb-3">
            {{ $errors->first('general') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-3">
            {{ session('success') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

</div>