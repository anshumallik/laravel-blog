@extends('frontend.layouts.app')
@section('page-name', 'User Profile')
@section('user-profile', 'active')
@section('content')
    <section class="user_profile_page pt-5 pb-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-10 mx-auto">
                    <div class="row">
                        <div class="col-md-2">
                            <h4 class="profile">Profile</h4>
                        </div>
                        <div class="col-md-10">
                            <div class="">
                                <p class="mb-0">Logged in as <span class="fw-bold text-dark">
                                        {{ auth()->user()->name }}/{{ auth()->user()->email }}
                                    </span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-10 user_profile_setting mx-auto">
                    <div class="row gy-5">
                        <div class="col-lg-4 col-md-12">
                            <div class="user_information">
                                <div class="card rounded-0">
                                    <div class="card-body">
                                        <div class="user_tabs">
                                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                                aria-orientation="vertical">

                                                <a class="nav-link active" id="v-pills-profile-tab" data-toggle="pill"
                                                    data-target="#v-pills-profile">
                                                    <i class="fa fa-pencil-square-o mr-3"></i>
                                                    Profile</a>
                                                <a class="nav-link" id="v-pills-password-tab" data-toggle="pill"
                                                    data-target="#v-pills-password"><i class="fa fa-lock mr-3"></i>
                                                    Password</a>
                                                <a class="nav-link" id="v-pills-email-tab" data-toggle="pill"
                                                    data-target="#v-pills-email"><i class="fa fa-lock mr-3"></i>
                                                    Email</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-8 user_profile_form">
                            <div class="card">
                                <div class="card-body">
                                    <div class="tab-content" id="v-pills-tabContent">

                                        <div class="tab-pane fade" id="v-pills-password">
                                            <div class="form_data_user">
                                                <h3 class="mb-3 title_a">Password</h3>

                                                <form action="{{ route('frontend.userNewPassword') }}" method="POST"
                                                    id="userpasswordForm">
                                                    @csrf
                                                    <div class="form-group mb-3">
                                                        <label for="">Current Password <span
                                                                class="text-danger">*</span></label>
                                                        <input type="password" class="form-control"
                                                            placeholder="Please enter your current password"
                                                            name="current_password" value="">
                                                        <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                                                        @error('current_password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="">New Password <span
                                                                class="text-danger">*</span></label>
                                                        <input type="password" id="password" class="form-control"
                                                            placeholder="Please enter your new password" name="password">
                                                        <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                                                        @error('password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="">Confirm New Password <span
                                                                class="text-danger">*</span></label>
                                                        <input type="password" id="password_confirmation"
                                                            class="form-control" placeholder="Please retype your password"
                                                            name="password_confirmation">
                                                        <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                                                    </div>

                                                    <div class="btns mt-4">
                                                        <button type="submit" class="btn btn-save rounded-0">
                                                            Save Changes
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade  active show" id="v-pills-profile">
                                            <div class="form_data_user">
                                                <h3 class="mb-3 title_a">Profile</h3>
                                                <form action="{{ route('frontend.changeUserProfile') }}" method="POST"
                                                    id="updateUserProfileForm" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group mb-3">
                                                        <div class="row">
                                                            <div class="col-md-12 mb-2">
                                                                <label for="">Avatar</label>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <img src="{{ asset('avatars/' . auth()->user()->avatar) }}"
                                                                    class="imageSize" id="imgPreview" />
                                                            </div>
                                                            <div class="col-md-9 my-auto">
                                                                <input type="file" class="form-control" name="avatar"
                                                                    onchange="showImg(this, 'imgPreview')">
                                                                @error('avatar')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror

                                                                <span> JPG, GIF or PNG, Max size: 10MB </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="username">Name </label>
                                                        <input type="text" class="form-control" name="name"
                                                            value="{{ old('name', $user->name) }}" />
                                                        <span>This is the name that will be visible on your
                                                            profile</span>
                                                    </div>


                                                    <div class="btns mt-4">
                                                        <button type="submit" class="btn btn-save rounded-0">
                                                            Save Changes
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-email">
                                            <div class="form_data_user">
                                                <h3 class="mb-3 title_a">Email</h3>

                                                <form action="{{ route('frontend.changeUserEmail') }}" method="POST"
                                                    id="changeUserEmailForm">
                                                    @csrf
                                                    <div class="form-group mb-3">
                                                        <label for="email">Email <span
                                                                class="text-danger">*</span></label>
                                                        <input type="email" placeholder="Please enter your email"
                                                            class="form-control" name="email"
                                                            value="{{ $user->email }}" readonly="readonly">
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="email">New Email<span
                                                                class="text-danger">*</span></label>
                                                        <input type="email" placeholder="Please enter your email"
                                                            class="form-control" name="email" value="">
                                                        @error('email')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <button type="submit" class="btn btn-login rounded-0">Save
                                                        Changes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $("#changeUserEmailForm").validate({
            rules: {
                email: {
                    required: {
                        depends: function() {
                            $(this).val($.trim($(this).val()));
                            return true;
                        }
                    },
                    customemail: true,
                },
            },
            messages: {
                email: {
                    required: "Email is required",
                    customemail: "Please enter valid email address",
                },
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
        $("#userpasswordForm").validate({
            rules: {
                current_password: {
                    required: true,
                },
                password: {
                    required: true,
                    passwordCheck: true,
                    minlength: 10,
                },
                password_confirmation: {
                    equalTo: "#password",
                },
            },
            messages: {
                password: {
                    required: "New Password is required",
                    minlength: "Password must be of at least 10 characters.",
                    passwordCheck: "Password must contain at least one uppercase , lowercase, digit and special character",
                },
                password_confirmation: {
                    equalTo: "Password confirmation does not match.",
                },
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
        $("#updateUserProfileForm").validate({
            rules: {
                name: {
                    required: true,
                    lettersonly: true,
                },
                user_address: {
                    stringonly: true,
                },
                phone: {
                    digits: true,
                    minlength: 10,
                    maxlength: 13
                },
            },
            messages: {
                email: {
                    required: "Email is required",
                    customemail: "Please enter valid email address",
                },
                phone: {
                    digits: "Phone must contain only numeric value",
                    minlength: "Phone must have at least 10 digits",
                    maxlength: "The phone length must not be greater than 13",
                },
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>
@endsection
