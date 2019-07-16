@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('layouts.headers.empty', [
        'title' => __('label.programme_management'),
        'description' => __('description.programme_management'),
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
                    <div id="alert" class="alert alert-success alert-dismissible fade show" role="alert" >
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
                        <p class="card-text">{nama_peserta} untuk papar nama peserta.</p>
                        <p class="card-text">{ic_peserta} untuk papar no. kad pengenalan peserta.</p>
                        <p class="card-text">{nama_program} untuk papar nama program.</p>
                        <p class="card-text">{lokasi_program} untuk papar lokasi program.</p>
                        <p class="card-text">{tarikh_program} untuk papar tarikh program.</p>
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
                                        <p class="card-title">Title</p>
                                    </div>
                                    <div class="col">
                                        <button type="submit"
                                                class="btn bg-gradient-success text-white float-right">
                                            <i class="fas fa-check"></i> Submit
                                        </button>
                                        <a target="_blank"href="{{ route('template.preview', ['id' => $certificate_conf->id]) }}"
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

                                            <label for="cert_select">{{ __('label.position') }}</label>
                                            <div class="form-inline ">
                                                <div class="input-group w-lg-50 w-sm-50">
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
                                                <div class="input-group w-lg-5- w-sm-50 ml-xl-2 ">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-primary" type="button"
                                                                readonly>{{ __('label.Y') }}</button>
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
                                    </div>
                                @endfor
                            </div>
                            <div class="card-footer">
                                <div class="row justify-content-end">
                                    <div class="col-3">
                                        <button type="submit"
                                                class="btn bg-gradient-success text-white float-right">
                                            <i class="fas fa-check"></i> Submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($contents->count() > 0)
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col">
                                        <p class="card-title">Title</p>
                                    </div>
                                    <div class="col">
                                        <button type="submit"
                                                class="btn bg-gradient-success text-white float-right">
                                            <i class="fas fa-check"></i> Submit
                                        </button>
                                        <a target="_blank"href="{{ route('template.preview', ['id' => $certificate_conf->id]) }}"
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

                                            <label for="cert_select">{{ __('label.axis_position') }}</label>
                                            <div class="form-inline ">
                                                <div class="input-group w-lg-50 w-sm-50">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-primary" type="button"
                                                                readonly>{{ __('label.x') }}</button>
                                                    </div>
                                                    <input type="number" name="x[]"
                                                           min="1" max="176"
                                                           class="form-control px-2"
                                                           placeholder="{{ __('label.x') }}"
                                                           value="{{ $content->x }}"
                                                    >
                                                </div>
                                                <div class="input-group w-lg-5- w-sm-50 ml-xl-2 ">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-primary" type="button"
                                                                readonly>{{ __('label.Y') }}</button>
                                                    </div>
                                                    <input type="number" name="y[]"
                                                           min="1" max="290"
                                                           class="form-control px-2"
                                                           placeholder="{{ __('label.y') }}"
                                                           value="{{ $content->y }}"
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="card-footer">
                                <div class="row justify-content-end">
                                    <div class="col-3">
                                        <button type="submit"
                                                class="btn bg-gradient-success text-white float-right">
                                            <i class="fas fa-check"></i> Submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col">
                                        <p class="card-title">Title</p>
                                    </div>
                                    <div class="col">

                                        <button type="submit" class="btn bg-gradient-success text-white float-right">
                                            <i class="fas fa-check"></i> Submit
                                        </button>
                                        <a target="_blank"href="{{ route('template.preview', ['id' => $certificate_conf->id]) }}"
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
                                        <label for="cert_select">{{ __('label.axis_position') }}</label>
                                        <div class="form-inline ">
                                            <div class="input-group w-lg-50 w-sm-50">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-primary" type="button"
                                                            readonly>{{ __('label.x') }}</button>
                                                </div>
                                                <input type="number" name="x[]"
                                                       min="1" max="176"
                                                       class="form-control px-2"
                                                       placeholder="{{ __('label.x') }}">
                                            </div>
                                            <div class="input-group w-lg-5- w-sm-50 ml-xl-2 ">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-primary" type="button"
                                                            readonly>{{ __('label.Y') }}</button>
                                                </div>
                                                <input type="number" name="y[]"
                                                       min="1" max="290"
                                                       class="form-control px-2"
                                                       placeholder="{{ __('label.y') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row justify-content-end">
                                    <div class="col-3">
                                        <button type="submit"
                                                class="btn bg-gradient-success text-white float-right">
                                            <i class="fas fa-check"></i> Submit
                                        </button>
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
                        <h5 class="card-title text-warning">{{ __('label.notice') }}</h5>
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
            console.log($(".clone-me").length);
            if ($(".clone-me").length > 4) return alert('Cannot be more than 5.');
            let $tr = $(this).closest('.clone-me');
            let $clone = $tr.clone();
            $clone.find(':input').val('');
            $tr.after($clone);
        });

        $(document).on('click', '.remove-me', function () {
            if ($(".clone-me").length < 2) return alert('Must be at least 1 candidate.');
            $(this).closest('.clone-me').remove();
        });
    </script>
@endpush