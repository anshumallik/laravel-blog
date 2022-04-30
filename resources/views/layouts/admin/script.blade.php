<!-- Library Bundle Script -->
<script src="{{ asset('admindata/js/libs.min.js') }}"></script>

<!-- External Library Bundle Script -->
<script src="{{ asset('admindata/js/external.min.js') }}"></script>

<script src="{{ asset('admindata/js/dashboard.js') }}"></script>

<!-- fslightbox Script -->
<script src="{{ asset('admindata/js/fslightbox.js') }}"></script>

<!-- Settings Script -->
<script src="{{ asset('admindata/js/setting.js') }}"></script>
{{-- Bootstrap --}}
<script src="{{ asset('admindata/js/bootstrap.min.js') }}"></script>

<!-- Slider-tab Script -->
<script src="{{ asset('admindata/js/slider-tabs.js') }}"></script>

<!-- Form Wizard Script -->
<script src="{{ asset('admindata/js/form-wizard.js') }}"></script>
{{-- Toaster --}}
<script src="{{ asset('newjs/toastr.min.js') }}"></script>
<!-- AOS Animation Plugin-->
<script src="{{ asset('admindata/js/aos.js') }}"></script>
<script src="{{ asset('newjs/jquery.min.js') }}"></script>
<script src="{{ asset('newjs/jquery-ui.js') }}"></script>
<!-- App Script -->
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script src="{{ asset('admindata/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('admindata/js/hope-ui.js') }}" defer></script>
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
<script>
    function submitForm(e) {
            e.preventDefault();
            $('.require').css('display', 'none');
            let url = $("#form").attr("action");
            $.ajax({
                url: url,
                type: 'post',
                data: new FormData($("#form")[0]),
                processData: false,
                contentType: false,
                cache: false,
                success: function(data) {
                    if (data.db_error) {
                        $(".alert-warning").css('display', 'block');
                        $(".db_error").html(data.db_error);
                    } else if (data.errors) {
                        var error_html = "";
                        $.each(data.errors, function(key, value) {
                            error_html = '<div>' + value + '</div>';
                            $('.' + key).css('display', 'block').html(error_html);
                        });
                    } else if (!data.errors && !data.db_error) {
                        location.href = data.redirectRoute;
                        toastr.success(data.msg);
                    }

                }
            });
        }

        $("#superadmin").removeClass('example');
        $("input:checkbox").change(function() {
            console.log('changed');
            $('input:checkbox').each(function() {
                var $this = $("#superadmin");
                if ($this.is(":checked")) {
                    $('input:checkbox').not($this).prop({
                        disabled: true,
                        checked: false
                    });
                } else {
                    $('input:checkbox').prop('disabled', false);
                }
                if ($(".example:checked").length > 0) {
                    $("#superadmin").prop({
                        disabled: true,
                        checked: false
                    });
                } else {
                    $("#superadmin").prop("disabled", false);
                }
            });
        });
    function showImg(img, previewId) {
        readInputURL(img, previewId);
    }

    function readInputURL(input, idName) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function(e) {
                $("#" + idName).attr('src', e.target.result).width(100).height(100);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function validate(event, email) {
        const $result = $("#result");
        const email_address = $(email).val();
        var keypressed = event.which;
        if (keypressed == 9) {
            if (validateEmail(email_address)) {
                $result.text("");
                return true;
            } else {
                $result.css("color", "red");
                $result.text("Email is not valid. Please enter valid email address");
                event.preventDefault();
                $(email).focus();
            }
        }

        return false;
    }
</script>

@yield('script')
