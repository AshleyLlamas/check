@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- <div class="py-4">
            @if(\Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <div class="alert-body">
                    {{ \Session::get('success') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            {{ \Session::forget('success') }}
            @if(\Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <div class="alert-body">
                    {{ \Session::get('error') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="card mb-0">
                <div class="card-body">
                    <h2 class="brand-text text-primary ms-1">Admin Login</h2>

                    <form class="auth-login-form mt-2" action="{{route('deviceLoginPost')}}" method="post">
                        @csrf
                        <div class="mb-1">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{old('email') }}" autofocus />
                            @if ($errors->has('email'))
                            <span class="help-block font-red-mint">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="mb-1">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Password</label>
                                <a href="{{url('auth/forgot-password-basic')}}">
                                    <small>Forgot Password?</small>
                                </a>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input type="password" class="form-control form-control-merge" id="password" name="password" tabindex="2" />
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                            @if ($errors->has('password'))
                            <span class="help-block font-red-mint">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary w-100" tabindex="4">Sign in</button>
                    </form>
                </div>
            </div>
            <!-- /Login basic -->
        </div> --}}

        <div class="py-4">
            <div class="card border-0 rounded-0 shadow mb-3">
                <form class="auth-login-form mt-2" action="{{route('deviceLoginPost')}}" method="post">
                    @csrf
                    <div class="row g-0">
                        <div class="card-body p-4">
                            <h6 class="text-center">INGRESAR COMO DISPOSITIVO</h6>
                            <hr class="mt-0 mb-4">
                            @if (\Session::get('error'))
                                <div class="alert alert-danger d-flex align-items-center" role="alert">
                                    <div>
                                        <i class="fa-solid fa-circle-exclamation"></i> {{ \Session::get('error') }}
                                    </div>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" id="email" name="email" value="{{old('email') }}" autofocus  class="form-control @if($errors->has('email')) is-invalid @endif">
                                        <label for="email" class="col-md-4 col-form-label">{{ __('Correo electrónico') }}</label>
                                        @if ($errors->has('email'))
                                            <p class="text-danger">{{ $errors->first('email') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="password" name="password" class="form-control @if($errors->has('password')) is-invalid @endif">
                                        <label for="password" class="col-md-4 col-form-label">{{ __('Contraseña') }}</label>
                                        @if ($errors->has('password'))
                                            <p class="text-danger">{{ $errors->first('password') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-top-0 mb-4 text-center">
                            <button type="submit" class="btn btn-primary">Ingresar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
