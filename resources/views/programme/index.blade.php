@extends('layouts.app', ['title' => __('Pengurusan Program')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Pengurusan Program'),
        'description' => __('This is your profile page. You can see the progress you\'ve made with your work and manage your projects or assigned tasks'),
        'class' => 'col-lg-7',
        'url' => '../public/argon/img/brand/teaching.jpg'
    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">{{ __('Users') }}</h3>
                            </div>
                            <div class="col text-right">
                                <div class="btn-group" role="group" aria-label="Third group">
                                    <button class="btn btn-icon btn-sm btn-2 btn-primary" type="button"
                                            data-toggle="modal" data-target="#filterProgram">
                                        <span class="btn-inner--icon"><i class="fas fa-filter"></i></span>
                                    </button>
                                    <a href="{{ route('programme.create') }}"
                                       class="btn btn-sm btn-primary">{{ __('Daftar program') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('placeholder.programme_name') }}</th>
                                <th scope="col">{{ __('placeholder.programme_date') }}</th>
                                <th scope="col">{{ __('Creation Date') }}</th>
                                <th scope="col">{{ __('Status Program') }}</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->programme_name }}</td>
                                    <td>{!! $user->programme_start !!}</td>
                                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $user->status }}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                @if ($user->id != auth()->id())
                                                    <form action="{{ route('user.destroy', $user) }}" method="post">
                                                        @csrf
                                                        @method('delete')

                                                        <a class="dropdown-item"
                                                           href="{{ route('user.edit', $user) }}">{{ __('Edit') }}</a>
                                                        <button type="button" class="dropdown-item"
                                                                onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                                            {{ __('Delete') }}
                                                        </button>
                                                    </form>
                                                @else
                                                    <a class="dropdown-item"
                                                       href="{{ route('profile.edit') }}">{{ __('Edit') }}</a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $users->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        @include('component.modal',[
              'id' => 'filterProgram',
              'title' => 'filter'
              ])
        @include('layouts.footers.auth')
    </div>
@endsection