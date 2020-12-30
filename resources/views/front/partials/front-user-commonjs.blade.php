<!-- JQuery -->
<script src="{{ asset('public/front/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('public/front/js/popper.min.js') }}"></script>
<!-- Bootstrap core JavaScript -->
<script src="{{ asset('public/front/js/bootstrap.min.js') }}"></script>
<!-- BlockUI -->
<script src="{{ asset('public/admin/bower_components/block-ui/jquery.blockUI.js') }}" type="text/javascript"></script>
<!-- OWL carousel JS -->
<script src="{{ asset('public/front/js/owl.carousel.min.js') }}"></script>


<script src="{{ asset('public/front/js/jquery.matchHeight.js') }}"></script>
<script src="{{ asset('public/front/js/dashboard3.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('public/admin/bower_components/toastr/toastr.min.js') }}"></script>
@toastr_render
<script>
    $(".addnew-btn").click(function() {
        $(".addnew-dropdown").toggleClass("show");
    });
</script>