<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{ asset('frontend/js/jquery-3.4.1.js') }}"></script>
<!-- jQuery  for scroll me js -->
<script src='{{ asset('frontend/js/jquery-min.js') }}'></script>
<!-- popper  -->
<script src="{{ asset('frontend/js/popper.min.js') }}"></script>
<!--  bootstrap -->
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<!-- Appear JavaScript -->
<script src="{{ asset('frontend/js/appear.js') }}"></script>
<!-- Jquery-migrate JavaScript -->
<script src='{{ asset('frontend/js/jquery-migrate.min.js') }}'></script>
<!-- Wow JavaScript -->
<script src='{{ asset('frontend/js/wow.min.js') }}'></script>
<!--  Custom JavaScript -->
<script src="{{ asset('frontend/js/custom.js') }}"></script>
<!-- countdownTimer JavaScript -->
<script src='{{ asset('frontend/js/jQuery.countdownTimer.min.js') }}'></script>
<!-- Owl.carousel JavaScript -->
<script src='{{ asset('frontend/js/owl.carousel.min.js') }}'></script>
<!-- Countdown JavaScript -->
<script src='{{ asset('frontend/js/countdown.js') }}'></script>
<!-- Jquery.countTo JavaScript -->
<script src='{{ asset('frontend/js/jquery.countTo.js') }}'></script>
<!-- Magnific-popup JavaScript -->
<script src='{{ asset('frontend/js/jquery.magnific-popup.min.js') }}'></script>
<script src="{{ asset('frontend/js/index.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ionicons/6.0.1/esm/ionicons.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="{{ asset('newjs/toastr.min.js') }}"></script>
<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-container",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    @if (Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch (type) {
        case 'info':
        toastr.info("{{ Session::get('message') }}");
        break;
    
        case 'warning':
        toastr.warning("{{ Session::get('message') }}");
        break;
    
        case 'success':
        toastr.success("{{ Session::get('message') }}");
        break;
    
        case 'error':
        toastr.error("{{ Session::get('message') }}");
        break;
        }
    @endif
</script>
@yield('script')
