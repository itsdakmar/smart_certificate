<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('argon') }}/img/brand/logo-auth.svg" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{ \Illuminate\Support\Facades\Storage::disk('local')->has(auth()->user()->image_url) ? route('profile.image', ['filename' => auth()->user()->image_url]) : asset('argon').'/img/theme/default-profile.jpg' }}">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Activity') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Support') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/logo-2.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-tv-2 text-blue"></i> {{ __('Dashboard') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#navbar-pengguna" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-pengguna">
                        <i class="fas fa-users text-blue"></i>
                        <span class="nav-link-text">{{ __('Users management') }}</span>
                    </a>

                    <div class="collapse" id="navbar-pengguna">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link @if(Route::currentRouteName() === 'profile.edit') active @endif" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-user text-blue"></i> {{ __('User\'s profile') }}
                                </a>
                            </li>
                            @role('admin')
                            <li class="nav-item">
                                <a class="nav-link @if(Route::currentRouteName() === 'user.index') active @endif" href="{{ route('user.index') }}">
                                    <i class="fas fa-users text-blue"></i> {{ __('List of users') }}
                                </a>
                            </li>
                            @endrole
                        </ul>
                    </div>
                </li>
                @hasanyrole('admin|secretariat|director')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('programme') }}">
                        <i class="fas fa-award text-blue"></i> {{ __('Programmes') }}
                    </a>
                </li>
                @endhasanyrole

                @role('admin')
                <li class="nav-item">
                    <a class="nav-link" href="#navbar-config" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-pengguna">
                        <i class="fas fa-file-signature text-blue"></i>
                        <span class="nav-link-text">{{ __('Certificate templates') }}</span>
                    </a>

                    <div class="collapse" id="navbar-config">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link @if(Route::currentRouteName() === 'template') active @endif" href="{{ route('template') }}">
                                    <i class="fas fa-file-signature text-blue"></i> {{ __('List of templates') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(Route::currentRouteName() === 'font') active @endif" href="{{ route('font') }}">
                                    <i class="fas fa-font text-blue"></i> {{ __('Font') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{--<li class="nav-item">--}}
                    {{--<a class="nav-link" href="#">--}}
                        {{--<i class="fas fa-cog text-blue"></i> {{ __('System Configs') }}--}}
                    {{--</a>--}}
                {{--</li>--}}
                @endrole
            </ul>
            <!-- Divider -->
            <hr class="my-3">
            <!-- Heading -->
            <h6 class="navbar-heading text-muted">Documentation</h6>
            <!-- Navigation -->
            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="{{ asset('argon') }}/user-manual.pdf">
                        <i class="ni ni-spaceship"></i> User Manual
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>