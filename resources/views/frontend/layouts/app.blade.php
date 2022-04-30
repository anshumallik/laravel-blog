<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script>
        document.getElementsByTagName("html")[0].className += " js";
    </script>
    <title>Phifi - Creative Agency HTML Template</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('frontend/images/favicon.ico') }}" />
    @include('frontend.layouts.style')
</head>

<body>
    <!-- loading -->
    <div id="loading">
        <div id="loading-center">
            <div class="load-img">
                <img src="{{ asset('frontend/images/loader.gif') }}" alt="loader">
            </div>
        </div>
    </div>
    <!-- loading End -->
    @include('frontend.layouts.navbar')
    @if (!\Illuminate\Support\Facades\Request::is('/'))
        @include('frontend.layouts.banner')
    @endif
    {{-- @include('frontend.layouts.banner') --}}
    <!-- Breadcrumb Start -->
    @yield('content')
    @include('frontend.layouts.footer')
    @include('frontend.layouts.script')

</body>

</html>
