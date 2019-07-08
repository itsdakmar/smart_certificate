@extends('layouts.app', ['title' => __('label.programme_register')])

@section('content')
    @include('layouts.headers.empty',
    [
    'title' => __('label.programme_register'),
    'description' => __('description.programme_register')
    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('label.programme_information') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('programme') }}"
                                   class="btn btn-sm btn-primary">{!!  __('label.btn_back') !!}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('programme.store') }}" autocomplete="off">
                            @csrf
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('programme_name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label"
                                           for="input-name">{{ __('label.programme_name') }}</label>
                                    <input type="text" name="programme_name" id="input-name"
                                           class="form-control form-control-alternative{{ $errors->has('programme_name') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('label.programme_name') }}"
                                           value="{{ old('programme_name') }}" required autofocus>

                                    @if ($errors->has('programme_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('programme_name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="input-daterange datepicker row align-items-center" id="programme_date">
                                    <div class="col">
                                        <div class="form-group {{ $errors->has('programme_start') ? ' has-danger' : '' }}">
                                            <label class="form-control-label"
                                                   for="input-name">{{ __('label.programme_start') }}</label>
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                                class="ni ni-calendar-grid-58"></i></span>
                                                </div>
                                                <input class="form-control"
                                                       placeholder="{{ __('label.programme_start') }}"
                                                       name="programme_start" type="text" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                   for="input-name">{{ __('label.programme_end') }}</label>
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                                class="ni ni-calendar-grid-58"></i></span>
                                                </div>
                                                <input class="form-control"
                                                       placeholder="{{ __('label.programme_end') }}"
                                                       name="programme_end" type="text" value="">
                                            </div>
                                            @if ($errors->has('programme_date'))
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('programme_date') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="text-left">
                                    <button type="submit"
                                            class="btn bg-gradient-success text-white mt-4">{!!  __('label.btn_save')  !!}</button>
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