@extends('layouts.app')

@section('title','Login')

@section('content')


    <div class="row justify-content-center">
        <div class="col-md-5">
         
            <div class="login-logo py-3 mt-5">
                <a href="{{ route('login') }}">
                    {{-- {!! file_get_contents(asset('images/logos/login_logo.svg')) !!} --}}
                    <img src="{{ asset('images/logos/login_logo.png') }}" >
                </a>
            </div>

            <div class="card card-outline card-color">
                <div class="card-header">
                    <b>Login</b>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>

                            <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                        
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>

                            <input type="password" name="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                        
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember">
                                    <label for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>

                            <div class="col-4">
                                <button type="submit" class="btn sign-in-btn-color btn-block"><i  class="fas fa-sign-in-alt fa-sm icon-rm"></i> Sign In</button>
                            </div>

                        </div>
                    </form>


                    {{-- <p class="mb-1">
                  <a href="forgot-password.html">I forgot my password</a>
                </p>
                <p class="mb-0">
                  <a href="register.html" class="text-center">Register a new membership</a>
                </p> --}}
                </div>
            </div>


        </div>
    </div>



@endsection
