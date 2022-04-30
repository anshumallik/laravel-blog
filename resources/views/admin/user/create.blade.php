@extends('layouts.admin.app')
@section('title', 'User')
@section('user', 'active')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <a>
                                    <span class="content-header">Create User</span>
                                </a>
                                <a href="{{ route('admin.user.index') }}" class="btn btn-primary float-right">
                                    <i class="fa fa-arrow-left"></i> Back to List
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data"
                                id="form">
                                @csrf
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <p class="db_error"></p>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="name">Full Name &nbsp;<span
                                                                    class="req">*</span></label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" name="name"
                                                                class="form-control @error('name') is-invalid @enderror"
                                                                placeholder="Enter full name" id=""
                                                                value="{{ old('name') }}">
                                                            <span class="require name text-danger"></span>
                                                            @error('name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="email">Email Address &nbsp;<span
                                                                    class="req">*</span></label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="email" name="email" placeholder="Enter email"
                                                                id="email" onkeydown="validate(event,$(this))"
                                                                class="form-control @error('email') is-invalid @enderror"
                                                                value="{{ old('email') }}">
                                                            <span id="result"></span>
                                                            <span class="require email text-danger"></span>
                                                            @error('email')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="password">Password <span
                                                                    class="req">*</span></label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="password" name="password"
                                                                placeholder="Enter password" id="password" value=""
                                                                class="form-control @error('password') is-invalid @enderror">
                                                            <span class="require password text-danger"></span>
                                                            @error('password')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="password_confirmation">Confirm Password <span
                                                                    class="req">*</span></label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="password" placeholder="Retype password"
                                                                name="password_confirmation"
                                                                class="form-control @error('password_confirmation') is-invalid @enderror">
                                                            @error('password_confirmation')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="status">Status <span
                                                                class="req">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <select name="status"
                                                            class="form-control select2 @error('status') is-invalid @enderror"
                                                            id="status" style="width: 100%">
                                                            <option value="1"
                                                                {{ old('status') == '1' ? 'selected' : '' }}>
                                                                Active</option>
                                                            <option value="0"
                                                                {{ old('status') == '0' ? 'selected' : '' }}>
                                                                Inactive</option>
                                                        </select>
                                                        <span class="require status text-danger"></span>
                                                        @error('status')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="avatar">Upload profile pic</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="file" name="avatar" id="img"
                                                            onchange="showImg(this, 'imgPreview')"
                                                            class="form-control @error('avatar') is-invalid @enderror">
                                                        <img src="#" id="imgPreview" alt="">
                                                        <span class="require avatar text-danger"></span>
                                                        @error('avatar')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-2">Note</div>
                                                    <div class="col-md-10">
                                                        <p>Password must contain at least uppercase, lowercase, numeric and
                                                            special characters(!@&$#%(){}^*+-)</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <button type="button" onclick="submitForm(event);"
                                        class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')

    <script>
        $(document).ready(function() {
            $(".alert-warning").css('display', 'none');
        });

        function submitForm(e) {
            e.preventDefault();
            $('.require').css('display', 'none');
            let url = $("#form").attr("action");
            $.ajax({
                url: url,
                type: 'post',
                data: new FormData($("#form")[0]),
                processData: false,
                contentType: false,
                cache: false,
                success: function(data) {
                    if (data.db_error) {
                        $(".alert-warning").css('display', 'block');
                        $(".db_error").html(data.db_error);
                    } else if (data.errors) {
                        var error_html = "";
                        $.each(data.errors, function(key, value) {
                            error_html = '<div>' + value + '</div>';
                            $('.' + key).css('display', 'block').html(error_html);
                        });
                    } else if (!data.errors && !data.db_error) {
                        location.href = data.redirectRoute;
                        toastr.success(data.msg);
                    }

                }
            });
        }
    </script>
@endsection
