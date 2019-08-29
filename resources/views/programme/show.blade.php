@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('layouts.headers.empty', [
       'title' => $programme->programme_name,
        'description' => __('This is programme management page. Here you can see your programme details.'),
        'class' => 'col-lg-10'
    ])

    <style>
        .carousel-control-next-icon:after {
            content: '>';
            font-size: 30px;
            color: black;
        }

        .carousel-control-prev-icon:after {
            content: '<';
            font-size: 30px;
            color: black;
        }
    </style>



    <div class="container-fluid mt--7">

        @if (session('status'))
            <div class="row">
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
        <div class="row">

            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                <div class="card " id="border">
                    <div class="card-body">
                        <h5 class="heading-small card-title">{{ __('label.programme_information') }}</h5>


                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ asset('uploaded') }}/template/converted/{{ $programme->certParticipants->converted }}"
                                         class="img-fluid img-thumbnail"
                                         alt="Chosen layout">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{  asset('uploaded') }}/template/converted/{{ $programme->certCommittees->converted }}"
                                         class="img-fluid img-thumbnail"
                                         alt="Chosen layout">
                                </div>

                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                               data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="false"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                               data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="false"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                    </div>
                </div>

            </div>

            <div class="col-xl-8 order-xl-1">
                <div class="card  bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <ul class="nav nav-pills nav-fill">
                            <li class="nav-item ">
                                <a class="nav-link active" id="one-tab" data-toggle="tab" href="#one" role="tab"
                                   aria-controls="One" aria-selected="true">{{ __('label.programme_information') }}</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab"
                                   aria-controls="Two" aria-selected="false">{{ __('label.programme_photos') }}</a>
                            </li>
                            <li class="nav-item ">
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
                                    <div class="col-12">

                                        <h6 class="heading-small text-muted mb-4 ">{{ __('label.programme_information') }}


                                            @hasanyrole('admin|secretariat')
                                            @if($programme->status == 1)
                                                <a href="{{ route('programme.edit',$programme) }}"
                                                   class="btn btn-sm btn-primary text-right ml-2"><i
                                                            class="fas fa-pencil-alt mr-1"></i> {{ __('label.edit')}}
                                                </a>
                                            @endif
                                            @endhasanyrole
                                            @role('director')
                                            @if($programme->status == 2)

                                                <form style="display: inline;"
                                                      action="{{ route('programme.approve', $programme) }}"
                                                      method="post">
                                                    @csrf
                                                    @method('put')
                                                    <button type="button" class="btn btn-sm btn-success text-right ml-2"
                                                            onclick="confirm('{{ __("Are you sure you?") }}') ? this.parentElement.submit() : ''">
                                                        <i class="fas fa-check mr-1"></i>Approve
                                                    </button>
                                                </form>
                                            @endif
                                            @endrole
                                            @hasanyrole('director|admin|secretariat')

                                            @if($programme->status == 3)
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-primary" href="#" role="button"
                                                       data-toggle="dropdown" aria-haspopup="true"
                                                       aria-expanded="false">
                                                        <i class="fas fa-file-pdf mr-1"></i> {{ __('label.print_cert') }}
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a class="dropdown-item" target="_blank"
                                                           href="{{ route('programme.print', [$programme->id,'type' => 1]) }}">{{ __("Print Participant's Certificate") }}</a>
                                                        <a class="dropdown-item" target="_blank"
                                                           href="{{ route('programme.print', [$programme->id,'type' => 2]) }}">{{ __("Print Committee's Certificate") }}</a>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-primary" href="#" role="button"
                                                       data-toggle="dropdown" aria-haspopup="true"
                                                       aria-expanded="false">
                                                        <i class="fas fa-file-pdf mr-1"></i> {{ __('label.preview_certs') }}
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

                                                        <a class="dropdown-item"
                                                           href="{{ route('programme.preview', ['id' => $programme->id , 'type' => 1]) }}">{{ __('label.preview_cert_candidates')}}</a>
                                                        <a class="dropdown-item"
                                                           href="{{ route('programme.preview', ['id' => $programme->id , 'type' => 2]) }}">{{ __('label.preview_cert_committees')}}</a>
                                                    </div>
                                                </div>
                                            @endif
                                            @endhasanyrole

                                        </h6>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-borderless table-sm">
                                        <tr>
                                            <td><span class="text-uppercase">{{ __('label.programme_name') }}</span>
                                            </td>
                                            <td><span class="font-weight-bold text-uppercase">
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
                                                {!! $programme->label !!}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade p-3" style="overflow: auto;height: 500px;" id="two"
                                 role="tabpanel" aria-labelledby="two-tab">
                                @include('programme.gallery.index', ['programme' => $programme])
                            </div>
                            <div class="tab-pane fade p-3" id="three" role="tabpanel" aria-labelledby="three-tab">
                                @include('programme.document',['programme' => $programme])
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card  bg-secondary shadow mt-4">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col mb-0">{{ __('label.committees') }}</h3>
                            <div class="col text-right">
                                <div class="btn-group" role="group" aria-label="Third group">
                                    <button class="btn btn-icon btn-sm btn-2 btn-primary" type="button"
                                            data-toggle="modal" data-target="#filterProgram">
                                        <span class="btn-inner--icon"><i class="fas fa-filter"></i></span>
                                    </button>
                                    @hasanyrole('admin|secretariat')
                                    <a href="{{ route('candidate.create' , ['type' => 2, 'id' => $programme->id]) }}"
                                       class="btn btn-sm btn-primary">{{ __('label.add_committees') }}</a>
                                    <button class="btn btn-icon btn-sm btn-primary" type="button"
                                            data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

                                        <a class="dropdown-item" data-toggle="modal"
                                           data-target="#uploadCommittees">{{ __('label.upload_committees_excel') }}</a>

                                        <a class="dropdown-item"
                                           href="#">{{ __('label.download_committees_excel_template') }}</a>

                                    </div>
                                    @endhasanyrole
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table id="candidate-table"
                               class="table align-items-center table-flush table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('label.programme_committees_name') }}</th>
                                <th scope="col">{{ __('label.programme_committees_ic') }}</th>
                                <th scope="col">{{ __('label.programme_committees_task') }}</th>
                                @hasanyrole('admin|secreteriat')
                                <th scope="col">&nbsp;</th>
                                @endhasanyrole
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($committees as $committee)
                                <tr>
                                    <td>{{ $committee->name }}</td>
                                    <td>{{ $committee->identity_card }}</td>
                                    <td>{{ $committee->task }}</td>
                                    @hasanyrole('admin|secreteriat')
                                    <td class="programme-setting text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#"
                                               role="button"
                                               data-toggle="dropdown" aria-haspopup="true"
                                               aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <form action="{{ route('candidate.destroy', ['committee' => $committee, 'programme' => $programme]) }}"
                                                      method="post">
                                                    @csrf
                                                    @method('delete')

                                                    <a class="dropdown-item"
                                                       href="{{ route('candidate.edit', ['committee' => $committee, 'type' => 2]) }}">{{ __('Edit') }}</a>
                                                    <button type="button" class="dropdown-item"
                                                            onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
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
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $committees->links() }}
                        </nav>
                    </div>
                </div>

                <div class="card  bg-secondary shadow mt-4">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col mb-0">{{ __('label.candidate') }}</h3>
                            <div class="col text-right">
                                <div class="btn-group" role="group" aria-label="Third group">
                                    <button class="btn btn-icon btn-sm btn-2 btn-primary" type="button"
                                            data-toggle="modal" data-target="#filterProgram">
                                        <span class="btn-inner--icon"><i class="fas fa-filter"></i></span>
                                    </button>
                                    @hasanyrole('admin|secretariat')
                                    <a href="{{ route('candidate.create' , ['type' => 1, 'id' => $programme->id]) }}"
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
                                    @endhasanyrole
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
                                @hasanyrole('admin|secreteriat')
                                <th scope="col">&nbsp;</th>
                                @endhasanyrole
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($candidates as $candidate)
                                <tr>
                                    <td>{{ $candidate->name }}</td>
                                    <td>{{ $candidate->identity_card }}</td>
                                    @hasanyrole('admin|secreteriat')
                                    <td class="programme-setting text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#"
                                               role="button"
                                               data-toggle="dropdown" aria-haspopup="true"
                                               aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

                                                <form action="{{ route('candidate.destroy', ['candidate' => $candidate, 'programme' => $programme]) }}"
                                                      method="post">
                                                    @csrf
                                                    @method('delete')

                                                    <a class="dropdown-item"
                                                       href="{{ route('candidate.edit', ['candidate' => $candidate, 'type' => 1]) }}">{{ __('Edit') }}</a>
                                                    <button type="button" class="dropdown-item"
                                                            onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
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
                    'type' => 1,
                    'programme_id' => $programme->id
                    ])

    @include('component.modal-upload-excel',[
                'id' => 'uploadCommittees',
                'title' => 'Upload Excel Committees',
                'type' => 2,
                'programme_id' => $programme->id
                ])

    @include('component.modal-upload-document',[
              'id' => 'uploadDocument',
              'title' => 'Upload Document',
              'type' => 2,
              'programme_id' => $programme->id
              ])

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