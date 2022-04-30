@extends('frontend.layouts.app')
@section('page-name', 'Home')
@section('home', 'active')
@section('content')
    <!-- Banner -->
    <div id="iq-home" class="iq-banner">
        <div class="banner-objects">
            <span class="banner-objects-02">
                <img src="{{ asset('frontend/images/banner-pattern-1.png') }}" alt="#">
            </span>
        </div>
        <div class="container">
            <div class="banner-text">
                <div class="row">
                    <div class="col-md-12 col-lg-6 pr-0">
                        <h1 class="text-uppercase wow fadeIn">Enabling Organizations<br>To Grow Agency</h1>
                        <p class="iq-pt-15 iq-mb-40 wow fadeIn">It is a long established fact that a reader will be
                            distracted <span>by the readable content of a page when looking</span><span> at its
                                layout.</span></p>
                        <div class="btn-container text-left">
                            <a class="iq-button d-inline-block wow fadeIn mb-5 mb-lg-0" href="about-us.html"><span>Click
                                    Here</span><em></em></a>
                            <h4 class="iq-text wow fadeIn">Agency</h4>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="iq-banner-video">
                            <div class="waves-box">
                                <a href="" class="iq-video popup-youtube"><i class="ion-ios-play-outline"></i></a>
                                <div class="iq-waves">
                                    <div class="waves wave-1"></div>
                                    <div class="waves wave-2"></div>
                                    <div class="waves wave-3"></div>
                                </div>
                            </div>
                            <span class="banner-responsive">
                                <img src="{{ asset('frontend/images/banner-img.jpg') }}" alt="drive02">
                            </span>
                        </div>



                    </div>
                </div>
            </div>
        </div>
        <div class="banner-objects">
            <span class="banner-objects-01">
                <img src="{{ asset('frontend/images/banner-img.jpg') }}" alt="drive02">
            </span>
        </div>

    </div>
    <!-- Banner End -->
    <!-- Blog Start -->
    <section class="iq-blog-section iq-pb-55">
        <div class="container">
            <div class="row">
                <div class="iq-blog text-left ">
                    <div class="row">
                        @if (count($blogs) > 0)
                            @foreach ($blogs as $blog)
                                <div class="col-lg-4 col-md-6">
                                    <div class="iq-blog-box">
                                        <div class="iq-blog-image clearfix">
                                            <img src="{{ $blog->getImg($blog->image) }}" alt="#">
                                        </div>
                                        <div class="iq-blog-detail">
                                            <div class="blog-title">
                                                <a href="{{ route('frontend.blog_detail',$blog->slug) }}">
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
                                                        href="{{ route('frontend.blog_detail',$blog->slug) }}">Read
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
