@extends('layouts.app', ['title' => __('label.add_candidate')])

@section('content')
    @include('users.partials.header', ['title' => __('label.add_candidate')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <form method="post" action="{{ route('candidate.update' , ['id' => $candidate]) }}"
                          autocomplete="off">
                        @csrf
                        @method('put')
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">{{ __('label.add_candidate') }}</h3>
                                </div>
                                <div class="col-4 text-right">
                                    <a href="{{ route('programme') }}"
                                       class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="heading-small text-muted mb-4">{{ __('label.candidate_information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <table id="candidate-table" class="table table-flush">
                                        <tr>
                                            <td>
                                            <div class="form-group{{ $errors->has('candidate_name') ? ' has-danger' : '' }}">

                                                <label class="col-form-label">Candidate Name</label>
                                                <input type="text" name="candidate_name" id="input-name"
                                                       class="form-control form-control-alternative{{ $errors->has('programme_name') ? ' is-invalid' : '' }}"
                                                       placeholder="{{ __('label.candidate_name') }}"
                                                       value="{{ old('programme_name', $candidate->name) }}"
                                                       required
                                                       autofocus>

                                                @if ($errors->has('candidate_name'))
                                                    <span class="invalid-feedback"
                                                          role="alert"><strong>{{ $errors->get('candidate_name') }}</strong></span>
                                                @endif
                                            </div>
                                            </td>
                                            <td>
                                                <div class="form-group{{ $errors->has('candidate_ic') ? ' has-danger' : '' }}">

                                                    <label class="col-form-label">Candidate IC</label>

                                                    <input type="text" name="candidate_ic" id="input-name"
                                                           class="form-control form-control-alternative{{ $errors->has('programme_name') ? ' is-invalid' : '' }}"
                                                           placeholder="{{ __('label.candidate_ic') }}"
                                                           value="{{ old('candidate_ic', $candidate->identity_card) }}"
                                                           required>

                                                    @if ($errors->has('candidate_ic'))
                                                        <span class="invalid-feedback"
                                                              role="alert"><strong>{{ $errors->get('candidate_ic') }}</strong></span>
                                                    @endif
                                                </div>
                                            </td>

                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">{{ __('Update') }}</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
