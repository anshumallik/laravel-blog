@extends('frontend.layouts.app')
@section('page-name', 'Login')
@section('login', 'active')
@section('content')
    <section class="login-page pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-md-12 mx-auto">
                    <div class="row">
                        <div class="col-md-12 col-lg-8">
                            <h4 class="title_data">Welcome to Blog, Please Login </h4>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <div class="float-end float-media">
                                <h5 class="font-small mb-0">New member? <a href="{{ route('frontend.register') }}"
                                        class="blue">Register
                                    </a>here</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-4 rounded-0">
                        <div class="card-body">
                            @if (Session::has('error-message'))
                                <span class="text-danger"
                                    style="font-size: 80%;"><strong>{{ Session::get('error-message') }}</strong></span>
                            @endif
                            <form action="{{ route('login') }}" method="POST">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-login">

                                            @csrf
                                            <div class="form-group mb-3">
                                                <label for="">Email Address<span class="text-danger">*</span></label>
                                                <input type="email" placeholder="Please enter your email"
                                                    class="form-control @error('email') is-invalid @enderror" name="email">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="">Password <span class="text-danger">*</span></label>
                                                <input type="password" id="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    placeholder="Password" name="password" autocomplete="current-password">
                                                <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>


                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="login mb-2">
                                            <button class="btn btn-login w-100 rounded-0" type="submit">Login</button>
                                        </div>

                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
