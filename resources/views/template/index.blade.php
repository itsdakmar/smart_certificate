@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('layouts.headers.empty',[
    'title' => __('label.template_management'),

    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('label.template') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('template.create') }}"
                                   class="btn btn-sm btn-primary">{{ __('label.add_template') }}</a>
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

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('label.converted') }}</th>
                                <th scope="col">{{ __('label.layout_name') }}</th>
                                <th scope="col">{{ __('label.certificate_type') }}</th>
                                <th scope="col">{{ __('label.converting_status') }}</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($templates as $template)
                                <tr>
                                    <td><a href="/uploaded/template/converted/{{ $template->converted }}"><img src="/uploaded/template/converted/{{ $template->converted }}" class="img-thumbnail" width="150px"></a></td>
                                    <td>{{ $template->name }}</td>
                                    <td>{!! $template->certificate_type !!}</td>
                                    <td>{!! $template->convert_status !!}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item"
                                                   href="{{ route('template.edit', ['id' => $template->id]) }}">{{ __('edit.template') }}</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $templates->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection