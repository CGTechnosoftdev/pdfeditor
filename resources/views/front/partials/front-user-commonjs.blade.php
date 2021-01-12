<!-- JQuery -->
<script src="{{ asset('public/front/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('public/front/js/popper.min.js') }}"></script>
<!-- Bootstrap core JavaScript -->
<script src="{{ asset('public/front/js/bootstrap.min.js') }}"></script>
<!-- BlockUI -->
<script src="{{ asset('public/admin/bower_components/block-ui/jquery.blockUI.js') }}" type="text/javascript"></script>
<!-- datepicker -->
<script src="{{ asset('public/admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<!-- OWL carousel JS -->
<script src="{{ asset('public/front/js/owl.carousel.min.js') }}"></script>

<script src="{{ asset('public/front/js/jquery.matchHeight.js') }}"></script>

<script src="{{ asset('public/front/js/dashboard3.js') }}"></script>

<script src='https://cdn.jsdelivr.net/npm/bootstrap-colorpicker@3.0.3/dist/js/bootstrap-colorpicker.min.js'></script>
<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js')}}"></script>
<!-- Toastr -->
<script src="{{ asset('public/admin/bower_components/toastr/toastr.min.js') }}"></script>
@toastr_render
<script type="text/javascript" src="{{ asset('public/front/js/dropzone.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/front/js/upload-multi-files.js') }}"></script>

<script src=' https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js'> </script>
<script type="text/javascript" src="{{ asset('public/front/js/custom.js') }}"></script>
<script>
    // $(".addnew-btn").click(function() {
    //     $(".addnew-dropdown").toggleClass("show");
    // });

    $(document).ready(function() {
        $('.addnew-btn').click(function() {
            $(".addnew-dropdown").slideToggle("slow");
        });

        $(document).mouseup(function(e) {
            var popup = $(".addnew-dropdown");
            if (!$('.addnew-btn').is(e.target) && !popup.is(e.target) && popup.has(e.target).length == 0) {
                popup.hide(500);
            }
        });
    });
</script>