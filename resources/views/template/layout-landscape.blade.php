@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Hello') . ' '. auth()->user()->name,
        'description' => __('This is your profile page. You can see the progress you\'ve made with your work and manage your projects or assigned tasks'),
        'class' => 'col-lg-7'
    ])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('Template') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
                            <h1 class="display-4">Pricing</h1>
                            <p class="lead">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It’s built with default Bootstrap components and utilities with little customization.</p>
                        </div>

                        <div class="container">
                            <div class="card-deck mb-3 text-center">
                                <div class="card mb-4 shadow-sm">
                                    <div class="card-header">
                                        <h4 class="my-0 font-weight-normal">Portrait</h4>
                                    </div>
                                    <div class="card-body">
                                            <img src="{{ asset('argon') }}/img/template/potrait.svg" class="img-thumbnail my-3" style="height: 200px!important;" alt="Responsive image">
                                    </div>
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-lg btn-block btn-primary">Get started</button>
                                    </div>
                                </div>
                                <div class="card mb-4 shadow-sm">
                                    <div class="card-header">
                                        <h4 class="my-0 font-weight-normal">Landscape</h4>
                                    </div>
                                    <div class="card-body">
                                        <img src="{{ asset('argon') }}/img/template/landscape.svg" class="img-thumbnail my-3" style="height: 200px!important;" alt="Responsive image">
                                    </div>
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-lg btn-block btn-primary">Get started</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection