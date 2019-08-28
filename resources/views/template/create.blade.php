@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Add New Template Design'),
        'description' => __(''),
        'class' => 'col-lg-12'
    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-lg-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('New Template') }}</h3>
                        </div>
                    </div>
                    <form id="template-form" method="post" action="{{ route('template.upload') }}"
                          autocomplete="off"
                          enctype="multipart/form-data">
                        @csrf
                    <div class="card-body">

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
        @include('layouts.footers.auth')
    </div>
@endsection