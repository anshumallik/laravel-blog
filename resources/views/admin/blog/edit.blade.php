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
                                    <span class="content-header">Edit Blog</span>
                                </a>
                                <a href="{{ route('admin.blog.index') }}" class="btn btn-primary float-right">
                                    <i class="fa fa-arrow-left iCheck"></i>&nbsp;Back to List
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST"
                                enctype="multipart/form-data" id="form">
                                @csrf
                                @method('put')
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
                                                        <?php
                                                        $blog_categories = $blog->categories->pluck('slug')->toArray();
                                                        ?>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                {{ in_array($category->slug, $blog_categories) ? 'selected' : '' }}>
                                                                {{ $category->name }}</option>
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
                                                        <option value="">Select Category</option>
                                                        <?php
                                                        $blog_tags = $blog->tags->pluck('slug')->toArray();
                                                        ?>
                                                        @foreach ($tags as $tag)
                                                            <option value="{{ $tag->id }}"
                                                                {{ in_array($tag->slug, $blog_tags) ? 'selected' : '' }}>
                                                                {{ $tag->name }}</option>
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
                                                    <input type="text" name="name" value="{{ old('name', $blog->name) }}"
                                                        class="form-control" placeholder="Enter blog title">
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
                                                    <label for="description">Description</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <textarea name="description" id="ckeditor" class="form-control ckeditor">{!! $blog->description !!}</textarea>

                                                    @error('description')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="date">Date</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" name="date"
                                                        class="form-control @error('date') is-invalid @enderror"
                                                        placeholder="Enter date" id="datetime" value="{{ $blog->date }}">
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
                                                        <option value="1"
                                                            {{ old('status', $blog->status) == '1' ? 'selected' : '' }}>
                                                            Active</option>
                                                        <option value="0"
                                                            {{ old('status', $blog->status) == '0' ? 'selected' : '' }}>
                                                            Inactive</option>
                                                    </select>
                                                    <span class="require status text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="image">Upload Image</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="file" name="image" id="img"
                                                        onchange="showImg(this, 'imgPreview')"
                                                        class="form-control @error('image') is-invalid @enderror">
                                                    <img src="{{ $blog->getImg($blog->image) }}" id="imgPreview"
                                                        class="imgSize" alt="">
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
            $("#datetime").datepicker({
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
                _method: "put",
                data: new FormData(this.form),
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
