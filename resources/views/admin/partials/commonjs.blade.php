<!-- jQuery 3 -->
<script src="{{ asset('public/admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('public/admin/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
	$.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('public/admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- moment -->
<script src="{{ asset('public/admin/bower_components/moment/min/moment.min.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('public/admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<!-- datetimepicker -->
<script src="{{ asset('public/admin/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- select 2 -->
<script src="{{ asset('public/admin/bower_components/select2/dist/js/select2.min.js') }}"></script>
<!-- BlockUI -->
<script src="{{ asset('public/admin/bower_components/block-ui/jquery.blockUI.js') }}" type="text/javascript"></script>
<!-- Admin lte -->
<script src="{{ asset('public/admin/dist/js/adminlte.js') }}" type="text/javascript"></script>
<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js')}}"></script>
<!-- Toastr -->
<script src="{{ asset('public/admin/bower_components/toastr/toastr.min.js') }}"></script>
@toastr_render
<script src="{{ asset('public/admin/custom.js') }}"></script>