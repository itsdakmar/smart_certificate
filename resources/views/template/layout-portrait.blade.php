@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('layouts.headers.empty', [
        'title' => __('label.template_management'),
        'description' => __('description.template_management'),
        'url' => '../public/argon/img/brand/teaching.jpg'
    ])

    <style>
        @media only screen and (min-width: 768px) {
            .has-danger:after {
                transform: translateY(170%);
            }
        }

        .form-control.is-invalid {
            border: 1px solid #d9534f !important;
        }
    </style>

    <div class="container-fluid mt--6">
        <div class="row">

            @if (session('status'))
                <div class="col-12">
                    <div id="alert" class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif

            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow my-2">
                    <div class="card-body">
                        <h5 class="card-title text-warning">{{ __('label.notice') }}</h5>
                        <p class="card-text"><b>{nama_peserta}</b> untuk papar <b>nama peserta</b>.</p>
                        <p class="card-text"><b>{ic_peserta}</b> untuk papar <b>no. kad pengenalan peserta</b>.</p>
                        <p class="card-text"><b>{tugas}</b> untuk papar <b>tugas ahli yang terlibat</b>.</p>
                        <p class="card-text"><b>{nama_program}</b> untuk papar <b>nama program</b>.</p>
                        <p class="card-text"><b>{penganjur_program}</b> untuk papar <b>penganjur program</b>.</p>
                        <p class="card-text"><b>{lokasi_program}</b> untuk papar <b>lokasi program</b>.</p>
                        <p class="card-text"><b>{tarikh_program}</b> untuk papar <b>tarikh program</b>.</p>
                    </div>
                </div>

                <form action="{{ route('template.update',['id' => $certificate_conf->id]) }}" method="post"
                      autocomplete="off">
                    @csrf
                    @if(session('row'))

                        @php $row = session('row') @endphp
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col">
                                        <p class="card-title">Certificate Content</p>
                                    </div>
                                    <div class="col">
                                        <button type="submit"
                                                class="btn bg-gradient-success text-white float-right">
                                            <i class="fas fa-check"></i> Submit
                                        </button>
                                        <a target="_blank"
                                           href="{{ route('template.preview', ['id' => $certificate_conf->id]) }}"
                                           class="btn bg-gradient-primary text-white float-right mr-2">
                                            <span><i class="fas fa-eye"></i> Preview Certificate</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @for($index = 0;  $index < $row; $index++)
                                    <div class="card clone-me bg-secondary shadow my-2">
                                        <div class="card-body">
                                            <button type="button"
                                                    class="add-more btn btn-sm bg-gradient-gray text-white float-right mr-2 mb-4">
                                                <span><i class="fas fa-plus"></i> Add More </span>
                                            </button>
                                            <button type="button"
                                                    class="remove-me btn btn-sm bg-gradient-danger text-white float-right mr-2 mb-4">
                                                <span><i class="fas fa-minus"></i> Remove Me </span>
                                            </button>
                                            <label class="form-control-label"
                                                   for="input-name">{{ __('label.cert_content') }}</label>
                                            <div class="form-group{{ $errors->has('cert_content.'.$index) ? ' has-danger' : '' }}">
                                                <input type="text" name="cert_content[]" id="template"
                                                       class="form-control {{ $errors->has('cert_content.'.$index) ? ' is-invalid' : ' form-control-alternative' }}"
                                                       placeholder="{{ __('label.cert_content') }}"
                                                       value="{{ old('cert_content.'.$index) }}"
                                                       required {{ $errors->has('cert_content.'.$index) ? 'autofocus' : '' }}
                                                >

                                                @if ($errors->has('cert_content.'.$index))
                                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('cert_content.'.$index) }}</strong>
                                        </span>
                                                @endif
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-4 col-sm-12">
                                                    <label for="cert_select">{{ __('label.position') }}</label>
                                                    <div class="form-inline ">
                                                        <div class="input-group input-group-sm my-2">
                                                            <div class="input-group-prepend">
                                                                <button class="btn btn-primary" type="button"
                                                                        readonly>{{ __('label.x') }}</button>
                                                            </div>
                                                            <input type="number" name="x[]" min="1" max="176"
                                                                   class="form-control px-2 {{ $errors->has('x.'.$index) ? ' is-invalid' : '' }}"
                                                                   placeholder="{{ __('label.x') }}"
                                                                   value="{{ old('x.'.$index) }}"
                                                                   required {{ $errors->has('x.'.$index) ? 'autofocus' : '' }}
                                                            >
                                                        </div>
                                                        <div class="input-group input-group-sm my-2 ml-xl-2">
                                                            <div class="input-group-prepend">
                                                                <button class="btn btn-primary" type="button"
                                                                        readonly>{{ __('label.y') }}</button>
                                                            </div>
                                                            <input type="number" name="y[]" min="1" max="290"
                                                                   class="form-control px-2 {{ $errors->has('y.'.$index) ? ' is-invalid' : '' }}"
                                                                   placeholder="{{ __('label.y') }}"
                                                                   value="{{ old('y.'.$index) }}"
                                                                   required {{ $errors->has('y.'.$index) ? 'autofocus' : '' }}
                                                            >
                                                        </div>
                                                        @if ($errors->has('x.'.$index))
                                                            <span class="invalid-feedback" style="display:block;"
                                                                  role="alert"><strong>{{ $errors->first('x.'.$index) }}</strong></span>
                                                        @endif
                                                        @if ($errors->has('y.'.$index))
                                                            <span class="invalid-feedback" style="display:block;"
                                                                  role="alert"><strong>{{ $errors->first('y.'.$index) }}</strong></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-xl-2 col-sm-12">
                                                    <label for="cert_select">{{ __('label.font_size') }}</label>
                                                    <div class="input-group-sm my-2">
                                                        <input type="text" name="font_size[]" id="font_size"
                                                               class="form-control form-control-alternative"
                                                               placeholder="{{ __('label.font_size') }}"
                                                               value="{{ old('font_size.'.$index) }}"
                                                               required

                                                        >
                                                        @if ($errors->has('font_size.'.$index))
                                                            <span class="invalid-feedback" style="display:block;"
                                                                  role="alert"><strong>{{ $errors->first('font_size.'.$index) }}</strong></span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 col-sm-12">
                                                    <label for="cert_select">{{ __('label.margin') }}</label>
                                                    <div class="form-inline">
                                                        <div class="input-group input-group-sm my-2">
                                                            <div class="input-group-prepend">
                                                                <button class="btn btn-primary" type="button"
                                                                        readonly>{{ __('label.l') }}</button>
                                                            </div>
                                                            <input type="number" name="margin_left[]"
                                                                   min="-100" max="100"
                                                                   class="form-control px-2"
                                                                   placeholder="{{ __('label.l') }}"
                                                                   value="{{ old('margin_left.'.$index) }}">


                                                        </div>
                                                        <div class="input-group input-group-sm my-2 ml-xl-2">
                                                            <div class="input-group-prepend">
                                                                <button class="btn btn-primary" type="button"
                                                                        readonly>{{ __('label.r') }}</button>
                                                            </div>
                                                            <input type="number" name="margin_right[]"
                                                                   class="form-control px-2"
                                                                   min="-100" max="100"
                                                                   placeholder="{{ __('label.r') }}"
                                                                   value="{{ old('margin_right.'.$index) }}">
                                                        </div>

                                                        @if ($errors->has('margin_left.'.$index))
                                                            <span class="invalid-feedback" style="display:block;"
                                                                  role="alert"><strong>{{ $errors->first('margin_left.'.$index) }}</strong></span>
                                                        @endif

                                                        @if ($errors->has('margin_right.'.$index))
                                                            <span class="invalid-feedback" style="display:block;"
                                                                  role="alert"><strong>{{ $errors->first('margin_right.'.$index) }}</strong></span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-xl-2 col-sm-12">
                                                    <label for="cert_select">{{ __('label.alignment') }}</label>

                                                    <div class="btn-group btn-group-sm" role="group"
                                                         aria-label="Basic example">
                                                        <button type="button"
                                                                class="btn {{ (old('alignment.'.$index) == 'L') ? 'btn-primary' : 'btn-outline-primary' }} click-me"
                                                                data-value="L"><i class="fas fa-align-left"></i>
                                                        </button>
                                                        <button type="button"
                                                                class="btn {{ (old('alignment.'.$index) == 'C') ? 'btn-primary' : 'btn-outline-primary' }} click-me"
                                                                data-value="C"><i class="fas fa-align-center"></i>
                                                        </button>
                                                        <button type="button"
                                                                class="btn {{ (old('alignment.'.$index) == 'R') ? 'btn-primary' : 'btn-outline-primary' }} click-me"
                                                                data-value="R"><i class="fas fa-align-right"></i>
                                                        </button>
                                                    </div>
                                                    <input type="hidden" name="alignment[]"
                                                           value="{{ old('alignment.'.$index) }}" class="alignment">

                                                    @if ($errors->has('alignment.'.$index))
                                                        <span class="invalid-feedback" style="display:block;"
                                                              role="alert"><strong>{{ $errors->first('alignment.'.$index) }}</strong></span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                                <div class="card bg-secondary shadow my-2">
                                    <div class="card-body">

                                        <label class="form-control-label"
                                               for="input-name">{{ __('label.director_show') }}</label>

                                        <label class="custom-toggle  float-right mr-2 mb-4">
                                            <input name="show_director" class="toggle-me"
                                                   value="{{ old('show_director') }}"
                                                   {{ (old('show_director')? 'checked': '') }} type="checkbox">
                                            <span class="custom-toggle-slider rounded-circle"></span>
                                        </label>
                                        <span class=" float-right mr-2 mb-4">Show</span>
                                        @if ($errors->has('show_director'))
                                            <span class="invalid-feedback float-right mr-2 mb-4" style="display:block;"
                                                  role="alert"><strong>{{ $errors->first('show_director') }}</strong></span>
                                        @endif

                                        <div class="row show-me" style="display: {{(old('show_director')) ? 'block' : 'none'}} ">
                                            <div class="col-xl-2 col-sm-12">

                                                <label for="cert_select">{{ __('label.alignment') }}</label>

                                                <div class="btn-group btn-group-sm" role="group"
                                                     aria-label="Basic example">
                                                    <button type="button"
                                                            class="btn btn-outline-primary click-me"
                                                            data-value="L"><i class="fas fa-align-left"></i>
                                                    </button>
                                                    <button type="button"
                                                            class="btn btn-outline-primary click-me"
                                                            data-value="C"><i class="fas fa-align-center"></i>
                                                    </button>
                                                    <button type="button"
                                                            class="btn btn-outline-primary click-me"
                                                            data-value="R"><i class="fas fa-align-right"></i>
                                                    </button>
                                                </div>


                                                <input type="hidden" class="alignment" name="alignment_director"
                                                       value="">
                                            </div>
                                            @if ($errors->has('alignment_director'))
                                                <span class="invalid-feedback" style="display:block;"
                                                      role="alert"><strong>{{ $errors->first('alignment_director') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="card bg-secondary shadow my-2">
                                    <div class="card-body">

                                        <label class="form-control-label"
                                               for="input-name">{{ __('label.qr_code') }}</label>

                                        <div class="row">
                                            <div class="col-xl-4 col-sm-12">
                                                <label for="cert_select">{{ __('label.axis_position') }}</label>
                                                <div class="form-inline">
                                                    <div class="input-group input-group-sm my-2">
                                                        <div class="input-group-prepend">
                                                            <button class="btn btn-primary" type="button"
                                                                    readonly>{{ __('label.x') }}</button>
                                                        </div>
                                                        <input type="number" name="qr_x"
                                                               min="1" max="176"
                                                               class="form-control px-2"
                                                               placeholder="{{ __('label.x') }}"
                                                               value="{{ old('qr_x') }}">


                                                    </div>
                                                    <div class="input-group input-group-sm my-2 ml-xl-2">
                                                        <div class="input-group-prepend">
                                                            <button class="btn btn-primary" type="button"
                                                                    readonly>{{ __('label.y') }}</button>
                                                        </div>
                                                        <input type="number" name="qr_y"
                                                               min="1" max="290"
                                                               class="form-control px-2"
                                                               placeholder="{{ __('label.y') }}"
                                                               value="{{ old('qr_y') }}">
                                                    </div>
                                                    @if ($errors->has('qr_x'))
                                                        <span class="invalid-feedback" style="display:block;"
                                                              role="alert"><strong>{{ $errors->first('qr_x') }}</strong></span>
                                                    @endif
                                                    @if ($errors->has('qr_y'))
                                                        <span class="invalid-feedback" style="display:block;"
                                                              role="alert"><strong>{{ $errors->first('qr_y') }}</strong></span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-xl-6 col-sm-12">
                                                <label for="cert_select">{{ __('label.width_&_height') }}</label>
                                                <div class="form-inline">
                                                    <div class="input-group input-group-sm my-2">
                                                        <div class="input-group-prepend">
                                                            <button class="btn btn-primary" type="button"
                                                                    readonly>{{ __('label.width') }}</button>
                                                        </div>
                                                        <input type="number" name="qr_width"
                                                               min="1" max="50"
                                                               class="form-control px-2"
                                                               placeholder="{{ __('label.width') }}"
                                                               value="{{ old('qr_width') }}">


                                                    </div>
                                                    <div class="input-group input-group-sm my-2 ml-xl-2">
                                                        <div class="input-group-prepend">
                                                            <button class="btn btn-primary" type="button"
                                                                    readonly>{{ __('label.height') }}</button>
                                                        </div>
                                                        <input type="number" name="qr_height"
                                                               min="1" max="50"
                                                               class="form-control px-2"
                                                               placeholder="{{ __('label.height') }}"
                                                               value="{{ old('qr_height') }}">
                                                    </div>
                                                    @if ($errors->has('qr_width'))
                                                        <span class="invalid-feedback" style="display:block;"
                                                              role="alert"><strong>{{ $errors->first('qr_width') }}</strong></span>
                                                    @endif

                                                    @if ($errors->has('qr_height'))
                                                        <span class="invalid-feedback" style="display:block;"
                                                              role="alert"><strong>{{ $errors->first('qr_height') }}</strong></span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row justify-content-end">
                                    <div class="col">
                                        <button type="submit"
                                                class="btn bg-gradient-success text-white float-right">
                                            <i class="fas fa-check"></i> Submit
                                        </button>
                                        <a target="_blank"
                                           href="{{ route('template.preview', ['id' => $certificate_conf->id]) }}"
                                           class="btn bg-gradient-primary text-white float-right mr-2">
                                            <span><i class="fas fa-eye"></i> Preview Certificate</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($contents->count() > 0)
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col">
                                        <p class="card-title">Certificate Content</p>
                                    </div>
                                    <div class="col">
                                        <button type="submit"
                                                class="btn bg-gradient-success text-white float-right">
                                            <i class="fas fa-check"></i> Submit
                                        </button>
                                        <a target="_blank"
                                           href="{{ route('template.preview', ['id' => $certificate_conf->id]) }}"
                                           class="btn bg-gradient-primary text-white float-right mr-2">
                                            <span><i class="fas fa-eye"></i> Preview Certificate</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @foreach($contents->get() as $content)
                                    <div class="card clone-me bg-secondary shadow my-2">
                                        <div class="card-body">
                                            <button type="button"
                                                    class="add-more btn btn-sm bg-gradient-gray text-white float-right mr-2 mb-4">
                                                <span><i class="fas fa-plus"></i> Add More </span>
                                            </button>
                                            <button type="button"
                                                    class="remove-me btn btn-sm bg-gradient-danger text-white float-right mr-2 mb-4">
                                                <span><i class="fas fa-minus"></i> Remove Me </span>
                                            </button>
                                            <label class="form-control-label"
                                                   for="input-name">{{ __('label.cert_content') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="cert_content[]" id="template"
                                                       class="form-control form-control-alternative"
                                                       placeholder="{{ __('label.cert_content') }}"
                                                       value="{{ $content->content }}"
                                                       required
                                                >
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-4 col-sm-12">
                                                    <label for="cert_select">{{ __('label.axis_position') }}</label>
                                                    <div class="form-inline">
                                                        <div class="input-group input-group-sm my-2">
                                                            <div class="input-group-prepend">
                                                                <button class="btn btn-primary" type="button"
                                                                        readonly>{{ __('label.x') }}</button>
                                                            </div>
                                                            <input type="number" name="x[]"
                                                                   min="1" max="176"
                                                                   class="form-control px-2"
                                                                   placeholder="{{ __('label.x') }}"
                                                                   value="{{ $content->x }}">
                                                        </div>
                                                        <div class="input-group input-group-sm my-2 ml-xl-2">
                                                            <div class="input-group-prepend">
                                                                <button class="btn btn-primary" type="button"
                                                                        readonly>{{ __('label.y') }}</button>
                                                            </div>
                                                            <input type="number" name="y[]"
                                                                   min="1" max="290"
                                                                   class="form-control px-2"
                                                                   placeholder="{{ __('label.y') }}"
                                                                   value="{{ $content->y }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-2 col-sm-12">
                                                    <label for="cert_select">{{ __('label.font_size') }}</label>
                                                    <div class="input-group-sm my-2">
                                                        <input type="text" name="font_size[]" id="font_size"
                                                               class="form-control form-control-alternative"
                                                               placeholder="{{ __('label.font_size') }}"
                                                               value="{{ $content->font_size }}"
                                                               required

                                                        >
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 col-sm-12">
                                                    <label for="cert_select">{{ __('label.margin') }}</label>
                                                    <div class="form-inline">
                                                        <div class="input-group input-group-sm my-2">
                                                            <div class="input-group-prepend">
                                                                <button class="btn btn-primary" type="button"
                                                                        readonly>{{ __('label.l') }}</button>
                                                            </div>
                                                            <input type="number" name="margin_left[]"
                                                                   min="-100" max="100"
                                                                   class="form-control px-2"
                                                                   placeholder="{{ __('label.l') }}"
                                                                   value="{{ $content->margin_left }}">
                                                        </div>
                                                        <div class="input-group input-group-sm my-2 ml-xl-2">
                                                            <div class="input-group-prepend">
                                                                <button class="btn btn-primary" type="button"
                                                                        readonly>{{ __('label.r') }}</button>
                                                            </div>
                                                            <input type="number" name="margin_right[]"
                                                                   min="-100" max="100"
                                                                   class="form-control px-2"
                                                                   placeholder="{{ __('label.r') }}"
                                                                   value="{{ $content->margin_right }}">
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-xl-2 col-sm-12">
                                                    <label for="cert_select">{{ __('label.alignment') }}</label>

                                                    <div class="btn-group btn-group-sm" role="group"
                                                         aria-label="Basic example">
                                                        <button type="button"
                                                                class="btn {{ ($content->alignment == 'L') ? 'btn-primary' : 'btn-outline-primary' }} click-me"
                                                                data-value="L"><i class="fas fa-align-left"></i>
                                                        </button>
                                                        <button type="button"
                                                                class="btn {{ ($content->alignment == 'C') ? 'btn-primary' : 'btn-outline-primary' }} click-me"
                                                                data-value="C"><i class="fas fa-align-center"></i>
                                                        </button>
                                                        <button type="button"
                                                                class="btn {{ ($content->alignment == 'R') ? 'btn-primary' : 'btn-outline-primary' }} click-me"
                                                                data-value="R"><i class="fas fa-align-right"></i>
                                                        </button>
                                                    </div>
                                                    <input type="hidden" name="alignment[]"
                                                           value="{{ $content->alignment }}" class="alignment">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="card bg-secondary shadow my-2">
                                    <div class="card-body">

                                        <label class="form-control-label"
                                               for="input-name">{{ __('label.director_show') }}</label>

                                        <label class="custom-toggle  float-right mr-2 mb-4">
                                            <input name="show_director" class="toggle-me" value="1"
                                                   type="checkbox" {{ ($certificate_conf->show_director)? 'checked' : '' }}>
                                            <span class="custom-toggle-slider rounded-circle"></span>
                                        </label>
                                        <span class=" float-right mr-2 mb-4">Show</span>


                                        <div class="row show-me"
                                             style="display: {{ ($certificate_conf->show_director) ? 'block' : 'none' }};">
                                            <div class="col-xl-2 col-sm-12">

                                                <label for="cert_select">{{ __('label.alignment') }}</label>

                                                <div class="btn-group btn-group-sm" role="group"
                                                     aria-label="Basic example">
                                                    <button type="button"
                                                            class="btn {{ ($certificate_conf->alignment_director == 'L') ? 'btn-primary' : 'btn-outline-primary' }} click-me"
                                                            data-value="L"><i class="fas fa-align-left"></i>
                                                    </button>
                                                    <button type="button"
                                                            class="btn {{ ($certificate_conf->alignment_director == 'C') ? 'btn-primary' : 'btn-outline-primary' }} click-me"
                                                            data-value="C"><i class="fas fa-align-center"></i>
                                                    </button>
                                                    <button type="button"
                                                            class="btn {{ ($certificate_conf->alignment_director == 'R') ? 'btn-primary' : 'btn-outline-primary' }} click-me"
                                                            data-value="R"><i class="fas fa-align-right"></i>
                                                    </button>
                                                </div>
                                                <input type="hidden" name="alignment_director"
                                                       value="{{ $certificate_conf->alignment_director }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card bg-secondary shadow my-2">
                                    <div class="card-body">

                                        <label class="form-control-label"
                                               for="input-name">{{ __('label.qr_code') }}</label>

                                        <div class="row">
                                            <div class="col-xl-4 col-sm-12">
                                                <label for="cert_select">{{ __('label.axis_position') }}</label>
                                                <div class="form-inline">
                                                    <div class="input-group input-group-sm my-2">
                                                        <div class="input-group-prepend">
                                                            <button class="btn btn-primary" type="button"
                                                                    readonly>{{ __('label.x') }}</button>
                                                        </div>
                                                        <input type="number" name="qr_x"
                                                               min="1" max="176"
                                                               class="form-control px-2"
                                                               placeholder="{{ __('label.x') }}"
                                                               value="{{ $certificate_conf->qr_x }}">
                                                    </div>
                                                    <div class="input-group input-group-sm my-2 ml-xl-2">
                                                        <div class="input-group-prepend">
                                                            <button class="btn btn-primary" type="button"
                                                                    readonly>{{ __('label.y') }}</button>
                                                        </div>
                                                        <input type="number" name="qr_y"
                                                               min="1" max="290"
                                                               class="form-control px-2"
                                                               placeholder="{{ __('label.y') }}"
                                                               value="{{ $certificate_conf->qr_y }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-6 col-sm-12">
                                                <label for="cert_select">{{ __('label.width_&_height') }}</label>
                                                <div class="form-inline">
                                                    <div class="input-group input-group-sm my-2">
                                                        <div class="input-group-prepend">
                                                            <button class="btn btn-primary" type="button"
                                                                    readonly>{{ __('label.width') }}</button>
                                                        </div>
                                                        <input type="number" name="qr_width"
                                                               min="1" max="50"
                                                               class="form-control px-2"
                                                               placeholder="{{ __('label.width') }}"
                                                               value="{{ $certificate_conf->qr_width }}">
                                                    </div>
                                                    <div class="input-group input-group-sm my-2 ml-xl-2">
                                                        <div class="input-group-prepend">
                                                            <button class="btn btn-primary" type="button"
                                                                    readonly>{{ __('label.height') }}</button>
                                                        </div>
                                                        <input type="number" name="qr_height"
                                                               min="1" max="50"
                                                               class="form-control px-2"
                                                               placeholder="{{ __('label.height') }}"
                                                               value="{{ $certificate_conf->qr_height }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row justify-content-end">
                                    <div class="col">
                                        <button type="submit"
                                                class="btn bg-gradient-success text-white float-right">
                                            <i class="fas fa-check"></i> Submit
                                        </button>
                                        <a target="_blank"
                                           href="{{ route('template.preview', ['id' => $certificate_conf->id]) }}"
                                           class="btn bg-gradient-primary text-white float-right mr-2">
                                            <span><i class="fas fa-eye"></i> Preview Certificate</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else

                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col">
                                        <p class="card-title">Certificate Content</p>
                                    </div>
                                    <div class="col">

                                        <button type="submit" class="btn bg-gradient-success text-white float-right">
                                            <i class="fas fa-check"></i> Submit
                                        </button>
                                        <a target="_blank"
                                           href="{{ route('template.preview', ['id' => $certificate_conf->id]) }}"
                                           class="btn bg-gradient-primary text-white float-right mr-2">
                                            <span><i class="fas fa-eye"></i> Preview Certificate</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="card clone-me bg-secondary shadow mb-3">
                                    <div class="card-body">
                                        <button type="button"
                                                class="add-more btn btn-sm bg-gradient-gray text-white float-right mr-2 mb-4">
                                            <span><i class="fas fa-plus"></i> Add More </span>
                                        </button>
                                        <button type="button"
                                                class="remove-me btn btn-sm bg-gradient-danger text-white float-right mr-2 mb-4">
                                            <span><i class="fas fa-minus"></i> Remove Me </span>
                                        </button>
                                        <label class="form-control-label"
                                               for="input-name">{{ __('label.cert_content') }}</label>
                                        <div class="form-group">
                                            <input type="text" name="cert_content[]" id="template"
                                                   class="form-control form-control-alternative"
                                                   placeholder="{{ __('label.cert_content') }}"
                                                   value="{{ old('cert_content') }}"
                                                   required
                                            >
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-4 col-sm-12">
                                                <label for="cert_select">{{ __('label.axis_position') }}</label>
                                                <div class="form-inline">
                                                    <div class="input-group input-group-sm my-2 ">
                                                        <div class="input-group-prepend">
                                                            <button class="btn btn-primary" type="button"
                                                                    readonly>{{ __('label.x') }}</button>
                                                        </div>
                                                        <input type="number" name="x[]"
                                                               min="1" max="176"
                                                               class="form-control px-2"
                                                               placeholder="{{ __('label.x') }}">
                                                    </div>
                                                    <div class="input-group input-group-sm my-2 ml-xl-2">
                                                        <div class="input-group-prepend">
                                                            <button class="btn btn-primary" type="button"
                                                                    readonly>{{ __('label.y') }}</button>
                                                        </div>
                                                        <input type="number" name="y[]"
                                                               min="1" max="290"
                                                               class="form-control px-2"
                                                               placeholder="{{ __('label.y') }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-2 col-sm-12">
                                                <label for="cert_select">{{ __('label.font_size') }}</label>
                                                <div class="input-group-sm my-2">
                                                    <input type="text" name="font_size[]" id="font_size"
                                                           class="form-control form-control-alternative"
                                                           placeholder="{{ __('label.font_size') }}"
                                                           value="{{ old('font_size') }}"
                                                           required
                                                    >
                                                </div>
                                            </div>

                                            <div class="col-xl-6 col-sm-12">
                                                <label for="cert_select">{{ __('label.margin') }}</label>
                                                <div class="form-inline">
                                                    <div class="input-group input-group-sm my-2">
                                                        <div class="input-group-prepend">
                                                            <button class="btn btn-primary" type="button"
                                                                    readonly>{{ __('label.l') }}</button>
                                                        </div>
                                                        <input type="number" name="margin_left[]"
                                                               min="-100" max="100"
                                                               class="form-control px-2"
                                                               placeholder="{{ __('label.l') }}"
                                                        >
                                                    </div>
                                                    <div class="input-group input-group-sm my-2 ml-xl-2">
                                                        <div class="input-group-prepend">
                                                            <button class="btn btn-primary" type="button"
                                                                    readonly>{{ __('label.r') }}</button>
                                                        </div>
                                                        <input type="number" name="margin_right[]"
                                                               min="-100" max="100"
                                                               class="form-control px-2"
                                                               placeholder="{{ __('label.r') }}"
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-xl-2 col-sm-12">
                                                <label for="cert_select">{{ __('label.alignment') }}</label>

                                                <div class="btn-group btn-group-sm" role="group"
                                                     aria-label="Basic example">
                                                    <button type="button" class="btn btn-outline-primary click-me"
                                                            data-value="L"><i class="fas fa-align-left"></i></button>
                                                    <button type="button" class="btn btn-outline-primary click-me"
                                                            data-value="C"><i class="fas fa-align-center"></i></button>
                                                    <button type="button" class="btn btn-outline-primary click-me"
                                                            data-value="R"><i class="fas fa-align-right"></i></button>
                                                </div>
                                                <input type="hidden" name="alignment[]" class="alignment">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card bg-secondary shadow my-2">
                                    <div class="card-body">

                                        <label class="form-control-label"
                                               for="input-name">{{ __('label.director_show') }}</label>

                                        <label class="custom-toggle  float-right mr-2 mb-4">
                                            <input name="show_director" class="toggle-me" value="1" type="checkbox">
                                            <span class="custom-toggle-slider rounded-circle"></span>
                                        </label>
                                        <span class=" float-right mr-2 mb-4">Show</span>


                                        <div class="row show-me" style="display: none">
                                            <div class="col-xl-2 col-sm-12">

                                                <label for="cert_select">{{ __('label.alignment') }}</label>

                                                <div class="btn-group btn-group-sm" role="group"
                                                     aria-label="Basic example">
                                                    <button type="button"
                                                            class="btn btn-outline-primary click-me"
                                                            data-value="L"><i class="fas fa-align-left"></i>
                                                    </button>
                                                    <button type="button"
                                                            class="btn btn-outline-primary click-me"
                                                            data-value="C"><i class="fas fa-align-center"></i>
                                                    </button>
                                                    <button type="button"
                                                            class="btn btn-outline-primary click-me"
                                                            data-value="R"><i class="fas fa-align-right"></i>
                                                    </button>
                                                </div>
                                                <input type="hidden" class="alignment" name="alignment_director"
                                                       value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card bg-secondary shadow my-2">
                                    <div class="card-body">

                                        <label class="form-control-label"
                                               for="input-name">{{ __('label.qr_code') }}</label>

                                        <div class="row">
                                            <div class="col-xl-4 col-sm-12">
                                                <label for="cert_select">{{ __('label.axis_position') }}</label>
                                                <div class="form-inline">
                                                    <div class="input-group input-group-sm my-2">
                                                        <div class="input-group-prepend">
                                                            <button class="btn btn-primary" type="button"
                                                                    readonly>{{ __('label.x') }}</button>
                                                        </div>
                                                        <input type="number" name="qr_x"
                                                               min="1" max="176"
                                                               class="form-control px-2"
                                                               placeholder="{{ __('label.x') }}"
                                                        >
                                                    </div>
                                                    <div class="input-group input-group-sm my-2 ml-xl-2">
                                                        <div class="input-group-prepend">
                                                            <button class="btn btn-primary" type="button"
                                                                    readonly>{{ __('label.y') }}</button>
                                                        </div>
                                                        <input type="number" name="qr_y"
                                                               min="1" max="290"
                                                               class="form-control px-2"
                                                               placeholder="{{ __('label.y') }}"
                                                        >
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-8 col-sm-12">
                                                <label for="cert_select">{{ __('label.width_&_height') }}</label>
                                                <div class="form-inline">
                                                    <div class="input-group input-group-sm my-2">
                                                        <div class="input-group-prepend">
                                                            <button class="btn btn-primary" type="button"
                                                                    readonly>{{ __('label.width') }}</button>
                                                        </div>
                                                        <input type="number" name="qr_width"
                                                               min="1" max="50"
                                                               class="form-control px-2"
                                                               placeholder="{{ __('label.w') }}">
                                                    </div>
                                                    <div class="input-group input-group-sm my-2 ml-xl-2">
                                                        <div class="input-group-prepend">
                                                            <button class="btn btn-primary" type="button"
                                                                    readonly>{{ __('label.height') }}</button>
                                                        </div>
                                                        <input type="number" name="qr_height"
                                                               min="1" max="50"
                                                               class="form-control px-2"
                                                               placeholder="{{ __('label.h') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row justify-content-end">
                                    <div class="col">
                                        <button type="submit"
                                                class="btn bg-gradient-success text-white float-right">
                                            <i class="fas fa-check"></i> Submit
                                        </button>
                                        <a target="_blank"
                                           href="{{ route('template.preview', ['id' => $certificate_conf->id]) }}"
                                           class="btn bg-gradient-primary text-white float-right mr-2">
                                            <span><i class="fas fa-eye"></i> Preview Certificate</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </form>
            </div>
            <div class="col-xl-4 order-xl-2">
                <div class="card bg-secondary shadow my-2">
                    <div class="card-body">
                        <h5 class="card-title text-warning">{{ __('label.notice_position') }}</h5>
                        <img src="{{ asset('argon').'/img/template/layout/ref.png' }}"
                             class="img-fluid img-thumbnail">
                    </div>
                </div>
                <div class="card bg-secondary shadow my-2">
                    <div class="card-body">
                        <h5 class="card-title text-warning">{{ __('label.chosen_template') }}</h5>
                        <img src="/uploaded/template/converted/{{ $certificate_conf->converted }}"
                             class="img-fluid img-thumbnail">
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script>
        $(document).on('click', '.add-more', function () {
            let $tr = $(this).closest('.clone-me');
            let $clone = $tr.clone();
            $clone.find(':input').val('');
            $clone.children().find('.click-me').removeClass('btn-primary').addClass('btn-outline-primary')
            $tr.after($clone);
        });

        $(document).on('click', '.remove-me', function () {
            if ($(".clone-me").length < 2) return alert('Must be at least 1 content.');
            $(this).closest('.clone-me').remove();
        });

        $(document).on('click', '.click-me', function () {
            $(this).parent().children().removeClass('btn-primary').addClass('btn-outline-primary');
            $(this).removeClass('btn-outline-primary').addClass('btn-primary');
            $(this).parent().next().closest('.alignment').val($(this).data('value'));
        });

        $(document).on('click', '.toggle-me', function () {
            if ($(this)[0].checked === false) {
                $(this).parent().parent().find('.show-me').hide();
            }
            else {
                $(this).parent().parent().find('.show-me').show();
            }
        });

    </script>
@endpush