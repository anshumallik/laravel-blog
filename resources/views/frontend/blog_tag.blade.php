@extends('frontend.layouts.app')
@section('page-name', 'Blog Tag')
@section('blog-tag', 'active')
@section('content')

    <!-- Blog Start -->
    <section class="iq-blog-section iq-pb-55">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <h3 class="mb-4">{{ $blog_tag->name }}</h3>
                </div>
               
            </div>
            <div class="row">

                <div class="iq-blog text-left ">
                    <div class="row">

                        @if (count($blog_tags) > 0)
                            @foreach ($blog_tags as $blog_tag)
                                <div class="col-lg-4 col-md-6">
                                    <div class="iq-blog-box">
                                        <div class="iq-blog-image clearfix">
                                            <img src="{{ $blog_tag->getImg($blog_tag->image) }}" alt="#">
                                        </div>
                                        <div class="iq-blog-detail">
                                            <div class="blog-title">
                                                <a href="{{ route('frontend.blog_detail', $blog_tag->slug) }}">
                                                    <h4 class="mb-3">{{ $blog_tag->name }}</h4>
                                                </a>
                                            </div>
                                            <p class="iq-desc">{!! substr($blog_tag->description, 0, 100) !!}</p>
                                            <div class="blog-footer">
                                                <div class="iq-blog-meta">
                                                    <ul class="iq-postdate">
                                                        <li class="list-inline-item">
                                                            <i class="fa fa-calendar mr-1" aria-hidden="true"></i> <a
                                                                href="#">{{ date('j M Y', strtotime($blog_tag->date)) }}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="blog-button">
                                                    <a class="iq-link-button"
                                                        href="{{ route('frontend.blog_detail', $blog_tag->slug) }}">Read
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
                    {{ $blog_tags->links() }}

                </div>
            </div>
        </div>
    </section>

@endsection
