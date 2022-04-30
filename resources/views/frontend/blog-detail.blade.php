@extends('frontend.layouts.app')
@section('page-name', 'Blog Detail')
@section('blog', 'active')
@section('content')
   
    <!-- Blog Start -->
    <div class="iq-blog-section overview-block-ptb">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 mt-lg-0 mt-5">
                    <article id="post-218"
                        class="post-218 post type-post status-publish format-standard has-post-thumbnail hentry category-marketing tag-business tag-marketing">
                        <div class="iq-blog-box">
                            <div class="iq-blog-image clearfix">
                                <img src="images/blog/blog-1.jpg" class="img-fluid" alt="qloud" />
                            </div>
                            <div class="iq-blog-detail">
                                <div class="iq-blog-meta">
                                    <ul class="iq-postdate">
                                        <li class="list-inline-item">
                                            <i class="fa fa-calendar mr-2"></i>
                                            <span class="screen-reader-text">Posted on</span> <a href=""
                                                rel="bookmark"><time class="entry-date published updated"
                                                    datetime="">{{ date('j M Y', strtotime($blog->date)) }}</time></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="blog-content">
                                    {!! $blog->description !!}
                                </div>
                            </div>
                        </div>
                       
                       
                    </article>
                  
                </div>
                
            </div>
            
        </div>
    </div>
@endsection
