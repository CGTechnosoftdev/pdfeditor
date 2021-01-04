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
<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js')}}"></script>
<!-- Toastr -->
<script src="{{ asset('public/admin/bower_components/toastr/toastr.min.js') }}"></script>
@toastr_render
<script type="text/javascript" src="{{ asset('public/front/js/dropzone.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/front/js/upload-multi-files.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/front/custom.js') }}"></script>
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


    $('.content .single-document').on('click', function() {
        $(this).addClass('active').siblings().removeClass('active');
        $('.footer-more-menus').addClass('active').siblings().removeClass('active');
    });
</script>