 @include('front.partials.forms.link-to-fill-basic-form')
 @include('front.partials.forms.user-document-share-form')
 @section("additionaljs")

 <script type="text/javascript">
     $("document").ready(function() {
         $("div[id ^= 'document_list_item_']").click(function() {
             var idArray = $(this).attr('id').split("document_list_item_");

             $("#recent_document_select_item").val(idArray[1]);
         });




         $("#userDocTempConId").addClass("hide");
         $("#document-template-submit-id").click(function() {
             $("#user_document_template_form_id").submit();
         })



         $("#user_document_template_form_id").submit(function(e) {


             $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });

             e.preventDefault();
             var formData = new FormData(this);
             $.ajax({
                 type: 'POST',
                 url: "{{ route('front.user-document.template-form-save')}}",
                 data: formData,
                 cache: false,
                 dataType: 'json',
                 contentType: false,
                 processData: false,
                 success: (data) => {
                     // this.reset();
                     console.log(JSON.stringify(data));
                     //  var jsonData = $.parseJSON(data.responseText);
                     // alert('File has been uploaded successfully');
                     $("#userDocTempConId").removeClass("hide");
                     $("#userDocTempConId").removeClass("alert-danger");
                     $("#userDocTempConId").addClass("alert-success");
                     $("#userDocTempConId").addClass("show");
                     $("#userDocTempConId").html(data.message);

                     setTimeout(function() {
                         $("#userDocTempConId").removeClass("show");
                         $("#userDocTempConId").addClass("hide");
                     }, 3000);

                 },
                 error: function(data) {
                     var jsonData = $.parseJSON(data.responseText);
                     $("#userDocTempConId").removeClass("hide");
                     $("#userDocTempConId").removeClass("alert-success");
                     $("#userDocTempConId").addClass("alert-danger");
                     $("#userDocTempConId").addClass("show");
                     $("#userDocTempConId").html(jsonData.message);

                     setTimeout(function() {
                         $("#userDocTempConId").removeClass("show");
                         $("#userDocTempConId").addClass("hide");
                     }, 3000);
                 }
             });


         });

     });
 </script>

 @endsection