@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('layouts.headers.empty',[
    'title' => 'List of fonts',
    'description' => 'Here you can view, update and delete font for certificate\'s templates.'
    ])

    <style>

    </style>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-12">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session('failed'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('failed') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Add Font') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('programme') }}"
                                   class="btn btn-block btn-primary">{!!  __('label.btn_back_to_list') !!}</a>
                            </div>
                        </div>
                    </div>


                        <form method="post" action="{{ route('font.store') }}"
                              enctype="multipart/form-data" autocomplete="off">
                            @csrf

                            <div class="row p-3">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" class="form-control mx-3" id="font" name="name"
                                               aria-describedby="font"
                                               placeholder="Enter font name" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input mx-3" name="file"
                                                       id="font-file"
                                                       aria-describedby="font-file" accept=".ttf"
                                                       required>
                                                <label class="custom-file-label" style="display:block;" for="font-file">Choose
                                                    file</label>
                                            </div>
                                        </div>
                                        <small id="font-file" class="text-muted mx-3">
                                            Only TTF file is accepted.
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit"
                                        class="btn btn-block bg-gradient-success text-white">{!!  __('label.btn_save')  !!}</button>
                            </div>
                        </form>


                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('List of fonts') }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('Font name') }}</th>
                                <th scope="col">{{ __('Created by') }}</th>
                                <th scope="col">{{ __('Created at') }}</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($fonts as $font)
                                <tr>
                                    <td>{{ $font->name }}</td>
                                    <td>{{ $font->user->name }}</td>
                                    <td>{{ $font->created_at->format('d F Y') }}</td>
                                    <td>
                                        @role('admin')
                                        <form action="{{ route('font.destroy', $font) }}" method="post">
                                            @csrf
                                            @method('delete')

                                            <button type="button" class="btn btn-sm btn-icon-only text-light"
                                                    onclick="confirm('{{ __("Are you sure?") }}') ? this.parentElement.submit() : ''"
                                                    data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="text-danger fas fa-trash"></i>
                                            </button>
                                        </form>
                                        @endrole
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $fonts->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>

    @push('js')
        <script>
            $('.custom-file-input').on('change', function (e) {
                //get the file name
                var fileName = e.target.files[0].name;
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            })
        </script>
    @endpush
@endsection