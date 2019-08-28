@extends('layouts.app', ['title' => __('Programme Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Edit Programme')])

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

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <form method="post" action="{{ route('programme.update' ,['id' => $programmes->id]) }}"
                      autocomplete="off">
                    @csrf
                    @method('put')
                    <div class="card bg-secondary shadow">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">{{ __('Programme Management') }}</h3>
                                </div>
                                <div class="col-4 text-right">
                                    <a href="{{ route('programme') }}"
                                       class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                </div>
                            </div>
                        </div>


                        <div class="card-body">

                            <h6 class="heading-small text-muted mb-4">{{ __('Programme information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('programme_name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="programme_name" id="input-name"
                                           class="form-control form-control-alternative{{ $errors->has('programme_name') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('Name') }}"
                                           value="{{ old('programme_name', $programmes->programme_name) }}" required
                                           autofocus>

                                    @if ($errors->has('programme_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('programme_name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('organiser') ? ' has-danger' : '' }}">
                                    <label class="form-control-label"
                                           for="input-name">{{ __('label.organiser') }}</label>
                                    <input type="text" name="organiser" id="input-name"
                                           class="form-control form-control-alternative{{ $errors->has('organiser') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('label.organiser') }}"
                                           value="{{ old('organiser', $programmes->organiser) }}" required autofocus>

                                    @if ($errors->has('organiser'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('organiser') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="input-daterange datepicker row align-items-center" id="programme_date">
                                    <div class="col">
                                        <div class="form-group {{ $errors->has('programme_start') ? ' has-danger' : '' }}">
                                            <label class="form-control-label"
                                                   for="input-name">{{ __('Programme Start') }}</label>
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                                class="ni ni-calendar-grid-58"></i></span>
                                                </div>
                                                <input class="form-control" placeholder="Start date"
                                                       name="programme_start" type="text"
                                                       value="{{ old('programme_start', $programmes->programme_start->format('d/m/Y')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                   for="input-name">{{ __('Programme End') }}</label>
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                                class="ni ni-calendar-grid-58"></i></span>
                                                </div>
                                                <input class="form-control" placeholder="End date" name="programme_end"
                                                       type="text"
                                                       value="{{ old('programme_end', $programmes->programme_end->format('d/m/Y')) }}">
                                            </div>
                                            @if ($errors->has('programme_date'))
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('programme_date') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row pl-4">
                                <div class="col">
                                    <label class="form-control-label"
                                           for="input-name">{{ __('label.cert_for_participants') }}</label>
                                    <div style="overflow: auto; white-space: nowrap;">
                                        @foreach($participants as $participant)
                                            <label class="mx-2 py-4">
                                                <input type="radio" name="cert_participants"
                                                       {{ ($programmes->cert_participants == $participant->id) ? 'checked' : '' }} value="{{ $participant->id }}">
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

                            <div class="row pl-4">
                                <div class="col">
                                    <label class="form-control-label"
                                           for="input-name">{{ __('label.cert_for_committees') }}</label>
                                    <div style="overflow: auto; white-space: nowrap;">
                                        @foreach($committees as $committee)
                                            <label class="mx-2 py-4">
                                                <input type="radio"
                                                       {{ ($programmes->cert_committees == $committee->id) ? 'checked' : '' }} name="cert_committees"
                                                       value="{{ $committee->id }}">
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
                                        class="btn btn-block bg-gradient-success text-white">{!!  __('label.btn_update')  !!}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection