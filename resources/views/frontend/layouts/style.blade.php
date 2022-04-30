<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
<!-- Typography CSS -->
<link rel="stylesheet" href="{{ asset('frontend/css/typography.css') }}">
<!-- Style CSS -->
<link rel='stylesheet' href='{{ asset('frontend/css/phifi-style.css') }}' />
<!-- Responsive CSS -->
<link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="{{ asset('newcss/toastr.min.css') }}">
<style>
    .toast-top-container {
        position: absolute;
        top: 65px;
        width: 280px;
        right: 40px;
        height: auto;
    }

</style>
@yield('style')
