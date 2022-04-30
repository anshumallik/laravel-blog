<div class=" main-bg">
        <div class="container-fluid p-0">
            <div class="text-left iq-breadcrumb-one
               iq-bg-over black     ">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-sm-12">
                            <nav aria-label="breadcrumb" class="text-center iq-breadcrumb-two">
                                <h2 class="title">
                                    @yield('page-name')
                                </h2>
                                <ol class="breadcrumb main-bg">
                                    <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}"><i
                                                class="fa fa-home mr-2"></i>Home</a></li>
                                    <li class="breadcrumb-item active">@yield('page-name')</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>