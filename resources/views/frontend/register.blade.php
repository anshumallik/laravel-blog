@extends('frontend.layouts.app')
@section('page-name', 'Register')
@section('register', 'active')
@section('content')

    <section class="login-page pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-md-12 mx-auto">
                    <div class="row">
                        <div class="col-md-12 col-lg-8">
                            <h4 class="title_data">Create Your Account </h4>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <div class="float-end float-media">
                                <h5 class="font-small mb-0">Already member? <a class="blue"
                                        href="{{ route('frontend.login') }}">Login
                                    </a>here</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-4 rounded-0">
                        <div class="card-body">
                            <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-login">
                                            <div class="form-group mb-3">
                                                <label for="">Full Name <span class="text-danger">*</span></label>
                                                <input type="text" placeholder="Please enter your full name"
                                                    class="form-control @error('name') is-invalid @enderror" name="name">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="email">Email Address<span
                                                        class="text-danger">*</span></label>
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
                                                    placeholder="Password" name="password">
                                                <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="">Confirm Password <span class="text-danger">*</span></label>
                                                <input type="password" class="form-control" placeholder="Password"
                                                    name="password_confirmation">
                                                <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="">Image <span class="text-danger">*</span></label>
                                                <input type="file"
                                                    class="form-control @error('avatar') is-invalid @enderror mb-3"
                                                    name="avatar" onchange="showImg(this, 'imgPreview')" />


                                                @error('avatar')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <img src="" class="imageSize" id="imgPreview" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="login mb-2">
                                            <button class="btn btn-login w-100 rounded-0" type="submit">Signup</button>
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
