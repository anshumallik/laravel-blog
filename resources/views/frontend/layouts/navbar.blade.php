<?php
$nav_blog_categories = App\Models\Category::where('status', 1)
    ->with('blogs')
    ->orderBy('name')
    ->get();

$nav_blog_tags = App\Models\Tag::where('status', 1)
    ->with('blogs')
    ->orderBy('name')
    ->get();
?>

<header id="main-header" class="header-main">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="{{ route('frontend.index') }}">
                        <img class="img-fluid" src="{{ asset('frontend/images/logo.png') }}" alt="img">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="menu-btn d-inline-block" id="menu-btn">
                            <span class="line"></span>
                            <span class="line"></span>
                            <span class="line"></span>
                        </span>
                        <span class="ion-navicon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto w-100 justify-content-end">
                            <li class="nav-item">
                                <a class="nav-link @yield('home')" href="{{ route('frontend.index') }}" role="button">
                                    Home
                                </a>

                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link @yield('blog') dropdown-toggle" href="javascript:void(0)"
                                    id="navbarDropdown-4" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Categories
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown-4">
                                    @foreach ($nav_blog_categories as $nav_blog_category)
                                        <a class="dropdown-item"
                                            href="{{ route('frontend.blog', $nav_blog_category->slug) }}">{{ $nav_blog_category->name }}</a>
                                    @endforeach

                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle @yield('blog')" href="javascript:void(0)"
                                    id="navbarDropdown-3" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Tags
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown-3">
                                    @foreach ($nav_blog_tags as $nav_blog_tag)
                                        <a class="dropdown-item" href="{{ route('frontend.blog_tag', $nav_blog_tag->slug) }}">{{ $nav_blog_tag->name }}</a>
                                    @endforeach
                                </div>
                            </li>
                            @auth
                                <li class="nav-item">
                                    <div class="" id="user_profile_icon">
                                        <div class="user_image">
                                            <img src="{{ asset('avatars/' . auth()->user()->avatar) }}" alt="">
                                        </div>
                                    </div>
                                    <div class="card user-profile-style user-card" id="user_profile" style="">

                                        <div class="card-body">
                                            <div class="user_name_style"><a href="">
                                                    <h3>{{ auth()->user()->name }}</h3>
                                                </a>
                                            </div>
                                            <ul>
                                                <li>
                                                    <a href="{{ route('frontend.user_profile') }}"><i
                                                            class="fa fa-user-circle mr-3 profile-icon"></i>My Profile</a>
                                                </li>
                                                <li>
                                                    <form action="{{ route('logout') }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="logout_button">
                                                            <i class="fa fa-power-off mr-3 profile-icon"></i>Logout
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{ route('frontend.login') }}" role="button">
                                        Login
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{ route('frontend.register') }}" role="button">
                                        Register
                                    </a>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- Header End -->
