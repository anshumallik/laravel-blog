<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('frontend/images/favicon.ico') }}" />
    @include('layouts.admin.style')

</head>

<body class="  ">
    <!-- loader Start -->
    <div id="loading">
        <div class="loader simple-loader">
            <div class="loader-body"></div>
        </div>
    </div>
    <!-- loader END -->
    @include('layouts.admin.sidebar')
    <main class="main-content">
        <div class="position-relative iq-banner">
            @include('layouts.admin.header')

        </div>
        @yield('content')

        @include('layouts.admin.footer')

    </main>
    @include('layouts.admin.script')




</body>

</html>
