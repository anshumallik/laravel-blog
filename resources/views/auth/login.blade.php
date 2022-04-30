<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/*" sizes="192x192"  href="{{asset('frontend/images/logo.jpg')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('adminlogin/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('adminlogin/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('adminlogin/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('adminlogin/vendor/animate/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('adminlogin/vendor/css-hamburgers/hamburgers.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('adminlogin/vendor/animsition/css/animsition.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('adminlogin/vendor/select2/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('adminlogin/vendor/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('adminlogin/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('adminlogin/css/main.css')}}">

</head>
<body>

<div class="limiter">
    <div class="container-login100" style="background-image: url('{{asset("frontend/images/background1.png")}}');  background-repeat: no-repeat;
            background-size: cover;">
        <div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
            <form class="login100-form validate-form flex-sb flex-w" method="POST"
             action="{{ route('login') }}">
                @csrf
                <span class="login100-form-title p-b-32 text-center">
						 {{ __('Login') }}
					</span>

                <span class="txt1 p-b-11">
						{{ __('E-Mail Address') }}
					</span>
                <div class="wrap-input100 validate-input m-b-36" data-validate = "Email is required">
                    <input class="input100 @error('email') is-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <span class="focus-input100"></span>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>

                <span class="txt1 p-b-11">
						{{ __('Password') }}
					</span>
                <div class="wrap-input100 validate-input m-b-12"  data-validate = "Password is required">
						<span class="btn-show-pass">
							<i class="fa fa-eye"></i>
						</span>
                    <input id="password" class="input100 @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="current-password">
                    <span class="focus-input100"></span>
                </div>
                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <div class="flex-sb-m w-full p-b-48">
                    <div class="contact100-form-checkbox">
                        <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="label-checkbox100" for="ckb1">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                    
                </div>

                <div class="container-login100-form-btn text-center">
                    <button type="submit" class="login100-form-btn">
                        Login
                    </button>

                </div>

            </form>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>

<script src="{{asset('adminlogin/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('adminlogin/vendor/animsition/js/animsition.min.js')}}"></script>
<script src="{{asset('adminlogin/vendor/bootstrap/js/popper.js')}}"></script>
<script src="{{asset('adminlogin/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('adminlogin/vendor/select2/select2.min.js')}}"></script>
<script src="{{asset('adminlogin/vendor/daterangepicker/moment.min.js')}}"></script>
<script src="{{asset('adminlogin/vendor/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('adminlogin/vendor/countdowntime/countdowntime.js')}}"></script>
<script src="{{asset('adminlogin/js/main.js')}}"></script>
</body>
</html>