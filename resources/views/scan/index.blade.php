@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('layouts.headers.empty', [
       'title' => $programme->programme_name,
        'description' => __('This is programme management page. Here you can see your programme details.'),
        'class' => 'col-lg-10'
    ])

    <div class="container-fluid mt--7">
        <div class="row justify-content-center">
            <div class="col-xl-10 order-xl-1">
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
                                <a class="nav-link" id="two-tab" data-toggle="tab" href="#twohalf" role="tab"
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
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade p-3" style="overflow: auto;height: 500px;" id="two"
                                 role="tabpanel" aria-labelledby="two-tab">
                                @include('programme.gallery.index', ['programme' => $programme])
                            </div>
                            <div class="tab-pane fade p-3" style="overflow: auto;height: 500px;" id="twohalf"
                                 role="tabpanel" aria-labelledby="twohalf-tab">
                                @include('programme.gallery.video', ['programme' => $programme])
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
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table id="candidate-table"
                               class="table align-items-center table-flush table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('label.programme_committees_name') }}</th>
                                <th scope="col">{{ __('label.programme_committees_ic') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($committees as $committee)
                                <tr>
                                    <td>{{ $committee->name }}</td>
                                    <td>{{ $committee->hidden }}</td>
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
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="candidate-table"
                               class="table align-items-center table-flush table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('label.programme_student_name') }}</th>
                                <th scope="col">{{ __('label.programme_student_ic') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($candidates as $candidate)
                                <tr>
                                    <td>{{ $candidate->name }}</td>
                                    <td>{{ $candidate->hidden }}</td>
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
    </div>
@endsection