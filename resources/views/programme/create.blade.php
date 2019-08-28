@extends('layouts.app', ['title' => __('label.programme_register')])

@section('content')
    @include('layouts.headers.empty',
    [
    'title' => __('label.programme_register'),
    'description' => __('description.programme_register')
    ])

    <style>
        @media (max-width: 767px) {
            .float-sm-right {
                float: right;
            }
        }

        [type=radio] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        [type=radio] + img {
            cursor: pointer;
        }

        [type=radio]:checked + img {
            box-shadow: 0 0 2px 2px #2dce89;;
        }
    </style>
    <div class="container mt--7">
        <form method="post" action="{{ route('programme.store') }}" autocomplete="off">
            @csrf
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('label.programme_information') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('programme') }}"
                               class="btn btn-block btn-primary">{!!  __('label.btn_back_to_list') !!}</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col">
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
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group{{ $errors->has('organiser') ? ' has-danger' : '' }}">
                                <label class="form-control-label"
                                       for="input-name">{{ __('label.organiser') }}</label>
                                <input type="text" name="organiser" id="input-name"
                                       class="form-control form-control-alternative{{ $errors->has('organiser') ? ' is-invalid' : '' }}"
                                       placeholder="{{ __('label.organiser') }}"
                                       value="{{ old('organiser') }}" required autofocus>

                                @if ($errors->has('organiser'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('organiser') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group{{ $errors->has('programme_location') ? ' has-danger' : '' }}">
                                <label class="form-control-label"
                                       for="input-name">{{ __('label.programme_location') }}</label>
                                <input type="text" name="programme_location" id="input-name"
                                       class="form-control form-control-alternative{{ $errors->has('programme_location') ? ' is-invalid' : '' }}"
                                       placeholder="{{ __('label.programme_location') }}"
                                       value="{{ old('programme_location') }}" required autofocus>

                                @if ($errors->has('programme_location'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('programme_location') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="input-daterange align-items-center input-group" id="programme_date">
                                <div class="col pl-0">
                                    <div class="form-group">
                                        <label class="form-control-label"
                                               for="input-name">{{ __('label.programme_start') }}</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                                class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input class="form-control {{ $errors->has('programme_start') ? ' is-invalid' : '' }}"
                                                   placeholder="{{ __('label.programme_start') }}"
                                                   name="programme_start" type="text" value="">
                                        </div>
                                        @if ($errors->has('programme_start'))
                                            <span class="invalid-feedback" style="display:block;" role="alert">
                                            <strong>{{ $errors->first('programme_start') }}</strong>
                                        </span>
                                        @endif
                                    </div>


                                </div>
                                <div class="col pr-0">
                                    <div class="form-group">
                                        <label class="form-control-label"
                                               for="input-name">{{ __('label.programme_end') }}</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                                class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input class="form-control {{ $errors->has('programme_end') ? ' is-invalid' : '' }}"
                                                   placeholder="{{ __('label.programme_end') }}"
                                                   name="programme_end" type="text" value="">
                                        </div>
                                        @if ($errors->has('programme_end'))
                                            <span class="invalid-feedback" style="display:block;" role="alert">
                                            <strong>{{ $errors->first('programme_end') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label class="form-control-label"
                                   for="input-name">{{ __('label.cert_for_participants') }}</label>
                            <div style="overflow: auto; white-space: nowrap;">
                                @foreach($participants as $participant)
                                    <label class="mx-2 py-4">
                                        <input type="radio" name="cert_participants" value="{{ $participant->id }}">
                                        <img src="/uploaded/template/converted/{{ $participant->converted }}"
                                             class="img-thumbnail" width="160px">
                                    </label>
                                @endforeach
                            </div>
                            @if ($errors->has('cert_participants'))
                                <span class="invalid-feedback" style="display: block" role="alert">
                                            <strong>{{ $errors->first('cert_participants') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label class="form-control-label"
                                   for="input-name">{{ __('label.cert_for_committees') }}</label>
                            <div style="overflow: auto; white-space: nowrap;">
                                @foreach($committees as $committee)
                                    <label class="mx-2 py-4">
                                        <input type="radio" name="cert_committees" value="{{ $committee->id }}">
                                        <img src="/uploaded/template/converted/{{ $committee->converted }}"
                                             class="img-thumbnail" width="160px">
                                    </label>
                                @endforeach
                            </div>
                            @if ($errors->has('cert_committees'))
                                <span class="invalid-feedback" style="display: block" role="alert">
                                            <strong>{{ $errors->first('cert_committees') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                        <button type="submit"
                                class="btn btn-block bg-gradient-success text-white">{!!  __('label.btn_save')  !!}</button>
                </div>
            </div>
        </form>
        @include('layouts.footers.auth')
    </div>
@endsection