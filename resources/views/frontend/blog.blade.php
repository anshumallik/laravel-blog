@extends('frontend.layouts.app')
@section('page-name', 'Blog')
@section('blog', 'active')
@section('content')

    <!-- Blog Start -->
    <section class="iq-blog-section iq-pb-55">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <h3 class="mb-4">{{ $blog_category->name }}</h3>
                </div>
                <div class="col-md-3 float-right">
                    <div id="search-2" class="widget widget_search">
                        <form class="input-group search_css search-form" method="get" id="formSearch"
                            action="{{ route('frontend.search') }}">
                           <label for="search-form-5e875eae921cb">
                           <span class="screen-reader-text">Search for:</span>
                           </label>
                           <input type="text" id="search-form-5e875eae921cb" class="search-field"
                            placeholder="Search …" name="query">
                           <button type="submit" class="search-submit"><i class="fa fa-search"></i><span class="screen-reader-text">Search</span></button>
                        </form>
                     </div>
                </div>
            </div>
            <div class="row">

                <div class="iq-blog text-left ">
                    <div class="row">

                        @if (count($blogs) > 0)
                            @foreach ($blogs as $blog)
                                <div class="col-lg-4 col-md-6">
                                    <div class="iq-blog-box">
                                        <div class="iq-blog-image clearfix">
                                            <img src="p" alt="#">
                                        </div>
                                        <div class="iq-blog-detail">
                                            <div class="blog-title">
                                                <a href="{{ route('frontend.blog_detail', $blog->slug) }}">
                                                    <h4 class="mb-3">{{ $blog->name }}</h4>
                                                </a>
                                            </div>
                                            <p class="iq-desc">{!! substr($blog->description, 0, 100) !!}</p>
                                            <div class="blog-footer">
                                                <div class="iq-blog-meta">
                                                    <ul class="iq-postdate">
                                                        <li class="list-inline-item">
                                                            <i class="fa fa-calendar mr-1" aria-hidden="true"></i> <a
                                                                href="#">{{ date('j M Y', strtotime($blog->date)) }}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="blog-button">
                                                    <a class="iq-link-button"
                                                        href="{{ route('frontend.blog_detail', $blog->slug) }}">Read
                                                        More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    {{ $blogs->links() }}

                </div>
            </div>
        </div>
    </section>
    
@endsection
