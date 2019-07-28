@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Hello') . ' '. auth()->user()->name,
        'description' => __('This is your profile page. You can see the progress you\'ve made with your work and manage your projects or assigned tasks'),
        'class' => 'col-lg-7'
    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('Template') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="template-form" method="post" action="{{ route('template.upload') }}"
                              autocomplete="off"
                              enctype="multipart/form-data">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">{{ __('label.template_info') }}</h6>

                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="pl-lg-4">
                                <div class="form-group {{ $errors->has('orientation') ? ' has-danger' : '' }}">
                                    <label for="orientation">{{ __('label.orientation') }}</label>
                                    <select name="orientation" class="form-control form-control-alternative {{ $errors->has('orientation') ? ' is-invalid' : '' }}" id="orientation" required>
                                        <option value="P">{{ __('label.portrait') }}</option>
                                        <option value="Lp">{{ __('label.landscape') }}</option>
                                    </select>

                                    @if ($errors->has('cert_type'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('cert_type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('layout_name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label"
                                           for="input-name">{{ __('label.layout_name') }}</label>
                                    <input type="text" name="layout_name" id="input-name"
                                           class="form-control form-control-alternative{{ $errors->has('layout_name') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('label.layout_name') }}"
                                           value="{{ old('layout_name') }}" required autofocus>

                                    @if ($errors->has('layout_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('layout_name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('cert_type') ? ' has-danger' : '' }}">
                                    <label for="cert_select">{{ __('label.cert_type') }}</label>
                                    <select name="cert_type" class="form-control form-control-alternative {{ $errors->has('cert_type') ? ' is-invalid' : '' }}" id="cert_select" required>
                                        <option value="1">{{ __('Penyertaan') }}</option>
                                        <option value="2">{{ __('Penghargaan') }}</option>
                                    </select>

                                    @if ($errors->has('cert_type'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('cert_type') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('template') ? ' has-danger' : '' }}">
                                    <label class="form-control-label"
                                           for="input-name">{{ __('label.template') }}</label>
                                    <input type="file" name="template" id="template"
                                           class="form-control form-control-alternative{{ $errors->has('template') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('label.template') }}"
                                           value="{{ old('template') }}" required autofocus>

                                    @if ($errors->has('template'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('template') }}</strong>
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
            <div class="col-xl-4 order-xl-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-warning">{{ __('label.notice') }}</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection