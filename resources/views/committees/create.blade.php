@extends('layouts.app', ['title' => __('label.add_committees')])

@section('content')
    @include('users.partials.header', ['title' => __('label.add_committees')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <form method="post" action="{{ route('candidate.store' , ['type' => $type, 'id' => $programme_id]) }}" autocomplete="off">
                        @csrf
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">{{ __('label.add_committees') }}</h3>
                                </div>
                                <div class="col-4 text-right">
                                    <a href="{{ route('programme') }}"
                                       class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="heading-small text-muted mb-4">{{ __('label.committee_information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <table id="candidate-table" class="table table-flush">

                                        @if(session('row'))
                                            @php $row = session('row') @endphp
                                            @for($index = 0;  $index < $row; $index++)
                                                <tr>
                                                    <td class="align-middle">
                                                        <p class="font-weight-bold">{{ $index+1 }}</p></td>
                                                    <td>
                                                        <div class="form-group{{ $errors->has('candidate_name.'.$index) ? ' has-danger' : '' }}">

                                                            <input type="text" name="candidate_name[]" id="input-name"
                                                                   class="form-control form-control-alternative{{ $errors->has('candidate_name.'.$index) ? ' is-invalid' : '' }}"
                                                                   placeholder="{{ __('label.committee_name') }}"
                                                                   value="{{ old('candidate_name.'.$index) }}"
                                                                   required
                                                                   autofocus>

                                                            @if ($errors->has('candidate_name.'.$index))
                                                                <span class="invalid-feedback"
                                                                      role="alert"><strong>{{ $errors->first('candidate_name.'.$index) }}</strong></span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group{{ $errors->has('candidate_ic.'.$index) ? ' has-danger' : '' }}">

                                                            <input type="text" name="candidate_ic[]" id="input-name"
                                                                   class="form-control form-control-alternative{{ $errors->has('candidate_ic.'.$index) ? ' is-invalid' : '' }}"
                                                                   placeholder="{{ __('label.committee_ic') }}"
                                                                   value="{{ old('candidate_ic.'.$index) }}"
                                                                   required>

                                                            @if ($errors->has('candidate_ic.'.$index))
                                                                <span class="invalid-feedback"
                                                                      role="alert"><strong>{{ $errors->first('candidate_ic.'.$index) }}</strong></span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                <button class="btn btn-icon btn-2 btn-primary add-more-candidate"
                                                                        style="display:block;" type="button">
                                                        <span class="btn-inner--icon"><i
                                                                    class="ni ni-fat-add"></i></span></button>
                                                                <button class="btn btn-icon btn-2 btn-danger remove-candidate"
                                                                        style="display:block;" type="button">
                                                        <span class="btn-inner--icon"><i
                                                                    class="ni ni-fat-remove"></i></span></button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endfor
                                        @else
                                            <tr>
                                                <td class="align-middle">
                                                    <p class="font-weight-bold">1</p></td>
                                                <td>
                                                    <div class="form-group{{ $errors->has('candidate_name') ? ' has-danger' : '' }}">

                                                        <input type="text" name="candidate_name[]" id="input-name"
                                                               class="form-control form-control-alternative{{ $errors->has('programme_name') ? ' is-invalid' : '' }}"
                                                               placeholder="{{ __('label.committee_name') }}"
                                                               value="{{ old('programme_name') }}"
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

                                                        <input type="text" name="candidate_ic[]" id="input-name"
                                                               class="form-control form-control-alternative{{ $errors->has('programme_name') ? ' is-invalid' : '' }}"
                                                               placeholder="{{ __('label.committee_ic') }}"
                                                               value="{{ old('candidate_ic') }}"
                                                               required>

                                                        @if ($errors->has('candidate_ic'))
                                                            <span class="invalid-feedback"
                                                                  role="alert"><strong>{{ $errors->get('candidate_ic') }}</strong></span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="btn-group" role="group"
                                                             aria-label="Basic example">
                                                            <button class="btn btn-icon btn-2 btn-primary add-more-candidate"
                                                                    style="display:block;" type="button">
                                                        <span class="btn-inner--icon"><i
                                                                    class="ni ni-fat-add"></i></span></button>
                                                            <button class="btn btn-icon btn-2 btn-danger remove-candidate"
                                                                    style="display:block;" type="button">
                                                        <span class="btn-inner--icon"><i
                                                                    class="ni ni-fat-remove"></i></span></button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script>

        $(document).on('click', '.add-more-candidate', function () {
            let $tr = $(this).closest('tr');
            let $clone = $tr.clone();
            $clone.find(':text').val('');
            $tr.after($clone);
            reSorting();
        });

        $(document).on('click', '.remove-candidate', function () {
            if ($("#candidate-table tr").length > 1) {
                $(this).closest('tr').remove();
                reSorting();
            } else {
                alert('Must be at least 1 candidate.')
            }
        });

        function reSorting() {
            $('#candidate-table tr').each(function (index) {
                $(this).children(':eq(0)').find('p').html(index + 1);
            });
        };
    </script>
@endpush