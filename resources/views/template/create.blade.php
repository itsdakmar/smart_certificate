@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Hello') . ' '. auth()->user()->name,
        'description' => __('This is your profile page. You can see the progress you\'ve made with your work and manage your projects or assigned tasks'),
        'class' => 'col-lg-7'
    ])

    <style>
        #border {
            display: inline-block;
            width: 100%;
            font-size: 0;
            line-height: 0;
            vertical-align: middle;
            background-size: 100%;
            /*background-position: 50% 50%;*/
            background-repeat: no-repeat;
            background-image: url({{ asset('argon').'/img/brand/border.png' }});
        }
    </style>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-5 order-xl-2 mb-5 mb-xl-0">
                <div class="card" id="border">
                    <div class="card-body">

                        <div class="container">

                            <div class="row justify-content-end pt-4">
                                <div class="col-4">
                                    <img src="{{ asset('argon').'/img/brand/logo_kkm.png' }}" class="float-right mr-2"
                                         id="logo_1" width="80px">
                                </div>
                                <div class="col-4">
                                    <img src="{{ asset('argon').'/img/brand/logo1.png' }}" class="float-right mr--4"
                                         id="logo_1"
                                         width="150px">
                                </div>
                            </div>
                            <div class="row justify-content-center py-2">
                                <div class="col">
                                    <h1 class="text-center"
                                        style="font-family: 'Pinyon Script', cursive; font-size: 40px">Sijil
                                        Kehadiran</h1>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-7">
                                    <div class="alert alert-primary text-center"
                                         style="font-size: 8px; padding: 0.5rem; border-radius: 0px; border-color: #553ca2; background-color: #553ca2;"
                                         role="alert">
                                        Dengan rasminya dianugerahkan kepada
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-7">
                                    <h5 class="text-center"> " NAMA PESERTA "</h5>
                                </div>
                            </div>

                            <div class="row mt-4 justify-content-center">
                                <div class="col-10">
                                    <h6 class="text-center">Atas kehadiran ke "NAMA PROGRAM" pada "TARIKH PROGRAM" di
                                        "LOKASI PROGRAM".</h6>
                                </div>
                            </div>

                            <div class="row mt-5 justify-content-center">
                                <div class="col-6">
                                    <table>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('argon').'/img/template/signature.jpg' }}"
                                                     class="float-right mr--4" id="signature" width="150px">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="text-center m--1" style="font-size: 13px">"NAMA PENGARAH"</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="text-center m--1" style="font-size: 13px">"JAWATAN"</p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="row mt-5 justify-content-between">
                                <div class="col-4">
                                    <i class="fas fa-certificate" style="font-size: 4rem; color: red;"></i>
                                </div>
                                <div class="col-4">
                                    <i class="fas fa-qrcode" style="font-size: 4rem;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-7 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('Template') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('profile.update') }}" autocomplete="off"
                              enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('Template information') }}</h6>

                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label"
                                           for="input-name"> {{ __('placeholder.border') }}</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="template-border">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label"
                                           for="input-name"> {{ __('placeholder.logo_1') }}</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="template-border">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label"
                                           for="input-name"> {{ __('placeholder.logo_2') }}</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="template-border">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection