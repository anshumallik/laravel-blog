@extends('layouts.admin.app')
@section('title', 'Blog')
@section('blog', 'active')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <a>
                                    <span class="content-header">Create Blog</span>
                                </a>
                                <a href="{{ route('admin.blog.index') }}" class="btn btn-primary float-right"><i
                                        class="fa fa-arrow-left iCheck"></i>&nbsp;Back to List</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data"
                                id="form">
                                @csrf
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <p class="db_error"></p>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="">Select Category</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <select name="categories" class="form-control">
                                                        <option value="">Select Category</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <span class="require categories text-danger"></span>
                                                    @error('categories')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="">Select Tag</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <select name="tags" class="form-control">
                                                        <option value="">Select Tag</option>
                                                        @foreach ($tags as $tag)
                                                            <option value="{{ $tag->id }}">{{ $tag->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <span class="require tags text-danger"></span>
                                                    @error('tags')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="name">Title&nbsp;<span
                                                            class="req">*</span></label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" name="name" value="{{ old('name') }}"
                                                        class="form-control" placeholder="Enter cateogry title">
                                                    <span class="require name text-danger"></span>
                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="description">Description&nbsp; <span
                                                            class="req">*</span></label>
                                                </div>
                                                <div class="col-md-9">
                                                    <textarea name="description" class="form-control ckeditor" id="ckeditor">{{ old('description') }}</textarea>
                                                    <span class="require description text-danger"></span>
                                                    @error('description')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="date">Date </label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" name="date" class="form-control"
                                                        onchange="datepicker('date')" id="date" autocomplete="off">
                                                    <span class="require date text-danger"></span>
                                                    @error('date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="status">Status</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <select name="status"
                                                        class="form-control select2 @error('status') is-invalid @enderror"
                                                        style="width: 100%">
                                                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>
                                                            Active</option>
                                                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>
                                                            Inactive</option>
                                                    </select>
                                                    <span class="require status text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="image">Image</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="file" name="image" id="img"
                                                        onchange="showImg(this, 'imgPreview')"
                                                        class="form-control @error('image') is-invalid @enderror">
                                                    <img src="#" id="imgPreview" alt="">
                                                    <span class="require image text-danger"></span>
                                                    @error('image')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group text-center">
                                            <button type="button" class="btn btn-primary"
                                                onclick="submitForm(event);">Submit</button>
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
@section('script')
    <script>
        $(document).ready(function() {
            $("#date").datepicker({
                format: 'yyyy-mm-dd',
                todayHighlight: true,
                clearBtn: true,
                autoclose: true,
                todayBtn: 'linked',
            });
        });
        $(document).ready(function() {
            $(".alert-warning").css('display', 'none');
        });

        function submitForm(e) {
            e.preventDefault();
            $('.require').css('display', 'none');
            let url = $("#form").attr("action");
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
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
