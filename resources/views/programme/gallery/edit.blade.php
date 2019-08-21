@extends('layouts.app', ['title' => __('Gallery Management')])

@section('content')
    @include('layouts.headers.empty', [
       'title' => 'Gallery Management',
        'description' => __('This is programme management page. Here you can see your programme details.'),
        'class' => 'col-lg-10'
    ])


    <div class="container-fluid mt--7">
        <div class="row mb-4">
            <div class="col-xl-12">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Gallery Management') }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="card-body">
                        <form class="form-inline" method="post" action="{{ route('gallery.store', $programme) }}"
                              enctype="multipart/form-data">
                            @method('post')
                            @csrf
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Choose Photos</label>

                            <div class="input-group my1">
                                <div class="custom-file">
                                    <input type="file" name="photos[]" class="custom-file-input" id="inputGroupGallery"
                                           accept="image/jpg, image/jpeg, image/png" multiple>
                                    <label class="custom-file-label" for="inputGroupFile02"
                                           aria-describedby="inputGroupFileAddon02">Choose Photos</label>
                                </div>
                            </div>

                            <button type="submit" class="ml-4 my-1 btn btn-primary">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Gallery Management') }}</h3>
                            </div>

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">{{ __('Uploaded By') }}</th>
                                <th scope="col">{{ __('Creation Date') }}</th>
                                <th scope="col" class="text-center">
                                    <div class="custom-control custom-checkbox mb-3">
                                        <input class="custom-control-input" id="checkAll" type="checkbox">
                                        <label class="custom-control-label" for="checkAll"></label>
                                    </div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <form action="{{ route('gallery.destroy', $programme) }}" method="post">
                                @csrf
                                @method('delete')

                                @foreach ($galleries as $index => $gallery)
                                    <tr>
                                        <td><a href="{{ route('gallery.photo', $gallery->path) }}"><img
                                                        src="{{ route('gallery.photo', $gallery->path) }}"
                                                        class="img-thumbnail" width="150px"></a></td>
                                        <td>{{ $gallery->user->name }}</td>
                                        <td>{{ $gallery->created_at }}</td>
                                        <td class="text-center">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input class="custom-control-input" id="customCheck-{{ $index }}"
                                                       type="checkbox" name="checked[]" value="{{ $gallery->id }}">
                                                <label class="custom-control-label"
                                                       for="customCheck-{{ $index }}"></label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center">
                                        <button type="submit" onclick="confirm('{{ __("Are you sure you want to delete?") }}') ? this.parentElement.submit() : ''" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </form>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $galleries->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        @push('js')
            <script>
                $(document).on('change', ':file', function () {
                    if ($(this).get(0).files.length > 10) {
                        alert("You can select only 10 images");
                        return false;
                    } else {
                        $('.custom-file-label').text($(this).get(0).files.length + ' Photo Selected');
                    }
                });

                $(document).on('click', '#checkAll', function () {
                    $('input:checkbox').prop('checked', this.checked);
                });

            </script>
        @endpush
        @include('layouts.footers.auth')
    </div>
@endsection