@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('layouts.headers.empty', [
        'title' => __('Hello') . ' '. auth()->user()->name,
        'description' => __('This is your profile page. You can see the progress you\'ve made with your work and manage your projects or assigned tasks'),
        'class' => 'col-lg-7'
    ])

    <style>
        .hovereffect {
            width: 100%;
            height: 100%;
            float: left;
            overflow: hidden;
            position: relative;
            text-align: center;
            cursor: default;
        }

        .hovereffect:hover {
            background: #5e72e4;
        }

        .hovereffect .overlay {
            width: 100%;
            height: 100%;
            position: absolute;
            overflow: hidden;
            top: 15%;
            left: 0;
            padding: 50px 20px;
        }

        .hovereffect:hover img {
            opacity: 0.2;
            filter: alpha(opacity=40);
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }

        .hovereffect a, .hovereffect:hover span, .hovereffect p {
            color: #FFF;
            opacity: 0;
            filter: alpha(opacity=0);
            -webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
            transition: opacity 0.35s, transform 0.35s;
            -webkit-transform: translate3d(100%, 0, 0);
            transform: translate3d(100%, 0, 0);
        }

        .hovereffect:hover a, .hovereffect:hover span, .hovereffect:hover p {
            opacity: 1;
            filter: alpha(opacity=100);
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }
    </style>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                <div class="card" id="border">
                    <div class="card-body">
                        <h5 class="heading-small card-title">{{ __('label.programme_information') }}</h5>
                        <div class="hovereffect">
                            <img src="{{ asset('argon') }}/img/template/layout/layout_2.png"
                                 class="img-fluid img-thumbnail"
                                 alt="Chosen layout">
                            <div class="overlay">
                                <p>
                                    <a href="#"><i class="fas fa-wrench fa-8x mb-4"></i>
                                        <br/>

                                        <span>Change Layout.</span>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <ul class="nav nav-pills nav-fill">
                            <li class="nav-item my-2">
                                <a class="nav-link active" id="one-tab" data-toggle="tab" href="#one" role="tab"
                                   aria-controls="One" aria-selected="true">{{ __('label.programme_information') }}</a>
                            </li>
                            <li class="nav-item my-2">
                                <a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab"
                                   aria-controls="Two" aria-selected="false">{{ __('label.programme_photos') }}</a>
                            </li>
                            <li class="nav-item my-2">
                                <a class="nav-link" id="three-tab" data-toggle="tab" href="#three" role="tab"
                                   aria-controls="Three" aria-selected="false">{{ __('label.programme_documents') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active p-3" id="one" role="tabpanel"
                                 aria-labelledby="one-tab">
                                <div class="row justify-content-between">
                                    <div class="col-6">

                                        <h6 class="heading-small text-muted mb-4 ">{{ __('label.programme_information') }}
                                            <a href="#" class="btn btn-sm btn-primary text-right ml-2"><i class="fas fa-pencil-alt mr-1"></i> {{('label.edit')}}</a></h6>


                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-borderless table-sm">
                                        <tr>
                                            <td><span class="text-uppercase">{{ __('label.programme_name') }}</span>
                                            </td>
                                            <td><span class="text-uppercase">
                                                {{ $programme->programme_name }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="text-uppercase">{{ __('label.programme_date') }}</span>
                                            </td>
                                            <td>
                                                <span class="text-uppercase">{!! $programme->programme_date !!}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="text-uppercase">{{ __('label.programme_location') }}</span>
                                            </td>
                                            <td>
                                                <span class="text-uppercase">{{ $programme->programme_location }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="text-uppercase">{{ __('label.programme_status') }}</span>
                                            </td>
                                            <td>
                                                {!! $programme->status !!}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade p-3" id="two" role="tabpanel" aria-labelledby="two-tab">
                                <h5 class="card-title">Tab Card Two</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the
                                    bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                            <div class="tab-pane fade p-3" id="three" role="tabpanel" aria-labelledby="three-tab">
                                <h5 class="card-title">Tab Card Three</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the
                                    bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>

                        </div>
                    </div>
                </div>

                @if (session('status'))
                    <div class="row mt-2">
                        <div class="col">

                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="card bg-secondary shadow {{ (!session('status')) ? 'mt-5' : '' }}">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col mb-0">{{ __('label.participants') }}</h3>
                            <div class="col text-right">
                                <div class="btn-group" role="group" aria-label="Third group">
                                    <button class="btn btn-icon btn-sm btn-2 btn-primary" type="button"
                                            data-toggle="modal" data-target="#filterProgram">
                                        <span class="btn-inner--icon"><i class="fas fa-filter"></i></span>
                                    </button>
                                    <a href="{{ route('candidate.create' , ['id' => $programme->id]) }}"
                                       class="btn btn-sm btn-primary">{{ __('label.add_participants') }}</a>
                                    <button class="btn btn-icon btn-sm btn-primary" type="button"
                                            data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

                                        <a class="dropdown-item" data-toggle="modal"
                                           data-target="#uploadCandidate">{{ __('label.upload_candidate_excel') }}</a>

                                        <a class="dropdown-item"
                                           href="#">{{ __('label.download_candidate_excel_template') }}</a>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table id="candidate-table"
                               class="table align-items-center table-flush table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('label.programme_student_name') }}</th>
                                <th scope="col">{{ __('label.programme_student_ic') }}</th>
                                <th scope="col">&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($candidates as $candidate)
                                <tr>
                                    <td>{{ $candidate->name }}</td>
                                    <td>{{ $candidate->identity_card }}</td>
                                    <td class="programme-setting text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#"
                                               role="button"
                                               data-toggle="dropdown" aria-haspopup="true"
                                               aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                @if ($candidate->id != auth()->id())
                                                    <form action="{{ route('user.destroy', $candidate) }}"
                                                          method="post">
                                                        @csrf
                                                        @method('delete')

                                                        <a class="dropdown-item"
                                                           href="{{ route('programme.edit', $candidate) }}">{{ __('Edit') }}</a>
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
                            {{ $candidates->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>

    @include('component.modal-upload-excel',[
                    'id' => 'uploadCandidate',
                    'title' => 'Upload Excel Candidate',
                    'programme_id' => $programme->id
                    ])


@endsection