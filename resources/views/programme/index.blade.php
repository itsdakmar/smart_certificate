@extends('layouts.app', ['title' => __('label.programme_management')])

@section('content')
    @include('layouts.headers.empty', [
        'title' => __('label.programme_management'),
        'description' => __('description.programme_management'),
        'url' => '../public/argon/img/brand/teaching.jpg'
    ])

    <style>
        .tooltip-inner {
            background-color: #5e72e4;
        }

        .tooltip.bs-tooltip-auto[x-placement^=top] .arrow::before, .tooltip.bs-tooltip-top .arrow::before {
            border-top-color: #5e72e4;
        }

        .tooltip.bs-tooltip-auto[x-placement^=bottom] .arrow::before, .tooltip.bs-tooltip-bottom .arrow::before {
            border-bottom-color: #5e72e4;
        }
    </style>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0 text-uppercase">{{ __('label.registered_programme') }}</h3>
                            </div>
                            <div class="col text-right">
                                <div class="btn-group" role="group" aria-label="Third group">
                                    <button class="btn btn-icon btn-sm btn-2 btn-primary" type="button"
                                            data-toggle="modal" data-target="#filterProgramme">
                                        <span class="btn-inner--icon"><i class="fas fa-filter"></i></span>
                                    </button>
                                    <a href="{{ route('programme.create') }}"
                                       class="btn btn-sm btn-primary ">{{ __('label.register_programme') }}</a>
                                </div>
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
                        <table id="programme-table" class="table align-items-center table-flush table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('label.programme_name') }}</th>
                                <th scope="col">{{ __('label.programme_date') }}</th>
                                <th scope="col">{{ __('label.created_by') }}</th>
                                <th scope="col">{{ __('label.programme_status') }}</th>
                                <th scope="col">{{ __('label.programme_total_cert') }}</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($programmes as $programme)
                                <tr data-href='{{ route('programme.show' , ['id' => $programme->id]) }}'>
                                    <td data-container="body" data-toggle="tooltip" data-placement="bottom"
                                        title="Click for more details.">
                                        <a href="#" class="text-decoration-none">{{ $programme->programme_name }}</a>
                                    </td>
                                    <td>{!! $programme->programme_date !!}</td>
                                    <td>{{ $programme->user->name  }}</td>
                                    <td>{!! $programme->status  !!}</td>
                                    <td>{{ $programme->user->name  }}</td>
                                    <td class="programme-setting text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                @if ($programme->id != auth()->id())
                                                    <form action="{{ route('user.destroy', $programme) }}"
                                                          method="post">
                                                        @csrf
                                                        @method('delete')

                                                        <a class="dropdown-item"
                                                           href="{{ route('programme.edit', $programme) }}">{{ __('Edit') }}</a>
                                                        <button type="button" class="dropdown-item"
                                                                onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                                            {{ __('Delete') }}
                                                        </button>
                                                    </form>
                                                @else
                                                    <a class="dropdown-item"
                                                       href="{{ route('profile.edit') }}">{{ __('Edit') }}</a>
                                                @endif
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
                            {{ $programmes->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        @include('component.modal-filter-programme')
        @include('layouts.footers.auth')
    </div>
@endsection