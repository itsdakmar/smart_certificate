@extends('layouts.app', ['title' => __('label.programme_management')])

@section('content')
    @include('layouts.headers.empty', [
        'title' => __('label.programme_management'),
        'description' => __('description.programme_management'),
        'url' => '../argon/img/brand/teaching.jpg'
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
                                    @hasanyrole('admin|secretariat')
                                    <a href="{{ route('programme.create') }}"
                                       class="btn btn-sm btn-primary ">{{ __('label.register_programme') }}</a>
                                    @endhasanyrole
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
                                <th scope="col">{{ __('label.programme_total_cert') }}</th>
                                <th scope="col">{{ __('label.programme_status') }}</th>
                                <th scope="col">{{ __('label.created_by') }}</th>
                                <th scope="col"></th>
                                @hasanyrole('admin|secreteriat')
                                <th scope="col"></th>
                                @endhasanyrole
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
                                    <td>{{ $programme->totalCertificate()  }}</td>
                                    <td>{!! $programme->label  !!}</td>
                                    <td>{{ $programme->user->name  }}</td>
                                    <td class="avoid">
                                        @hasanyrole('admin|secretariat')
                                        @if ($programme->totalCertificate() > 0 && $programme->status == 1)
                                            <form action="{{ route('programme.submit', $programme->id) }}"
                                                  method="post">
                                                @csrf
                                                @method('put')

                                                <button type="button" class="btn btn-sm btn-icon-only text-light"
                                                        onclick="confirm('{{ __("Are you sure you want to submit?") }}') ? this.parentElement.submit() : ''"
                                                        data-toggle="tooltip" data-placement="top" title="Submit">
                                                    <i class="text-success fas fa-paper-plane"></i>
                                                </button>
                                            </form>

                                        @elseif($programme->totalCertificate() > 0 && $programme->status == 3)
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-primary" href="#" role="button"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-print"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" target="_blank"
                                                       href="{{ route('programme.print', [$programme->id,'type' => 1]) }}">{{ __("Print Candidate's Certificate") }}</a>
                                                    <a class="dropdown-item" target="_blank"
                                                       href="{{ route('programme.print', [$programme->id,'type' => 2]) }}">{{ __("Print Committee's Certificate") }}</a>
                                                </div>
                                            </div>
                                        @endif
                                        @endhasanyrole
                                        @role('director')
                                        @if($programme->totalCertificate() > 0 && $programme->status == 2)
                                            <form action="{{ route('programme.approve', $programme->id) }}"
                                                  method="post">
                                                @csrf
                                                @method('put')

                                                <button type="button" class="btn btn-sm btn-icon-only text-light"
                                                        onclick="confirm('{{ __("Are you sure you want to approved?") }}') ? this.parentElement.submit() : ''"
                                                        data-toggle="tooltip" data-placement="top" title="Submit">
                                                    <i class="text-success fas fa-paper-plane"></i>
                                                </button>
                                            </form>
                                        @endif
                                        @endrole

                                    </td>
                                    @hasanyrole('admin|secreteriat')
                                    <td class="avoid text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

                                                <form action="{{ route('programme.destroy', $programme) }}"
                                                      method="post">
                                                    @csrf
                                                    @method('delete')

                                                    <a class="dropdown-item"
                                                       href="{{ route('programme.edit', $programme) }}">{{ __('Edit') }}</a>
                                                    <button type="button" class="dropdown-item"
                                                            onclick="confirm('{{ __("Are you sure you want to delete this programme?") }}') ? this.parentElement.submit() : ''">
                                                        {{ __('Delete') }}
                                                    </button>
                                                </form>

                                            </div>
                                        </div>
                                    </td>
                                    @endhasanyrole
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav>Scroll to view more <i class="ml-1 fas fa-long-arrow-alt-right"></i></nav>
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