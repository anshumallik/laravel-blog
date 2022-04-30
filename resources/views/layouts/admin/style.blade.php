<!-- Library / Plugin Css Build -->
<link rel="stylesheet" href="{{ asset('admindata/css/libs.min.css') }}" />

<!-- Aos Animation Css -->
<link rel="stylesheet" href="{{ asset('admindata/css/aos.css') }}" />
{{-- Bootstrap --}}
<link rel="stylesheet" href="{{ asset('admindata/css/bootstrap.min.css') }}" />
<!-- Hope Ui Design System Css -->
<link rel="stylesheet" href="{{ asset('admindata/css/hope-ui.min.css') }}" />
<link rel="stylesheet" href="{{ asset('newcss/jquery-ui.css') }}">
<!-- Custom Css -->
<link rel="stylesheet" href="{{ asset('admindata/css/custom.min.css') }}" />
{{-- toastr --}}
<link rel="stylesheet" href="{{ asset('newcss/toastr.min.css') }}">
<!-- Dark Css -->
<link rel="stylesheet" href="{{ asset('admindata/css/dark.min.css') }}" />

<!-- Customizer Css -->
<link rel="stylesheet" href="{{ asset('admindata/css/customizer.min.css') }}" />
<!-- RTL Css -->
<link rel="stylesheet" href="{{ asset('admindata/css/rtl.min.css') }}" />
<link rel="stylesheet" href="{{ asset('admindata/css/datepicker.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
<style>
    
    table.dataTable thead .sorting {
    background-image: url({{ asset('frontend/images/sort_both.png') }});
    cursor: pointer;
    background-repeat: no-repeat;
    background-position: center right;
}
</style>
@yield('style')
