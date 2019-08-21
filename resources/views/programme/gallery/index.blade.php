<!-- Page Content -->

<h1 class="font-weight-light text-center text-lg-left mt-4 mb-0">Programme Photos Gallery <a
            href="{{ route('programme.gallery', $programme) }}" class="btn btn-primary btn-sm float-right">Add & Edit
        Images</a></h1>

<hr class="mt-2 mb-5">

<div class="row text-center text-lg-left overflow-auto">
    @foreach ($programme->galleries as $gallery)
                <div class="col-lg-3 col-md-4 col-6">
        <a target="_blank" class="d-block mb-4 h-100" href="{{ route('gallery.photo', $gallery->path) }}"><img
                    src="{{ route('gallery.photo', $gallery->path) }}"
                    class="img-fluid img-thumbnail" width="150px"></a>
                </div>
    @endforeach
</div>

<!-- /.container -->