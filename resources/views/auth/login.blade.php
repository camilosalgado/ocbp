@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-sm-12 col-md-12 d-flex align-items-center justify-content-center"
                 style="min-height: 100vh !important; background: rgba(0,0,0,0.5) !important;">
                <div class="card" style="width: 80%; min-height: 40%; background: transparent !important; border: none !important;">
                    <div class="card-body">
                        <div class="form-group row mb-5 mt-4">
                            <div class="col-md-12 text-center">
                                <h1 style="font-weight: bolder; color: white !important;">Bienvenido a</h1>
                                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo">
                            </div>
                        </div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input placeholder="Ingrese su usuario" id="usuario" type="text"
                                           class="form-control form @error('usuario') is-invalid @enderror"
                                           name="usuario" value="{{ old('usuario') }}" required autocomplete="off"
                                           autofocus>

                                    @error('usuario')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input placeholder="Contraseña" id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember" style="color: white">
                                            {{ __('Recordar Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-block" style="background: #003366; color: white; font-weight: bold">
                                        {{ __('Ingresar') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}" style="color: white">
                                            {{ __('Olvidé Mi Contreña?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 d-flex align-items-center justify-content-center">

            </div>
        </div>
    </div>
@endsection
