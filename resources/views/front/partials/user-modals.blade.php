 @include('front.partials.forms.link-to-fill-basic-form')


 @include('front.partials.forms.user-document-share-form')


 @include('front.partials.forms.upload-document-form')
 @include('front.partials.forms.upload-template-form')
 @include('front.partials.forms.add-folder-form')

 @section("additionaljs")

 <script type="text/javascript">
     $("document").ready(function() {
         $("div[id ^= 'document_list_item_']").click(function() {
             var idArray = $(this).attr('id').split("document_list_item_");
             alert("selected item " + idArray[1]);
             $("#recent_document_select_item").val(idArray[1]);
         });
         $("a[id ^= 'share_by_link_']").click(function() {

             var idArray = $(this).attr("id").split("share_by_link_");
             $("#form_typeid").val(idArray[1])
         });

         $("#sharemenu_itemid").click(function() {

             $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });
             var user_document_id = $("#recent_document_select_item").val();
             //  alert("get item info " + user_document_id);
             $("#user_doc_id").val(user_document_id);
             $("#user_doc_id2").val(user_document_id);
             if (user_document_id != 0) {

                 $.ajax({
                     type: 'GET',
                     url: "{{ url('/user-document-share-get')}}/" + user_document_id,
                     success: function(data) {
                         $("#shareDocumentLinkId").html(data.file_url);
                         $("#shareDocumentLinkId").attr("href", data.file_url);
                         //user_document_id
                         $("#cust_share").modal("show");

                     }
                 });

             }



         });

         $("#share_button_id").click(function(e) {
             var share_type = $("#form_typeid").val();
             if (share_type == 1) {

                 e.preventDefault();
                 var formData = new FormData($("#user_document_send_email_form_id")[0]);
                 $.ajax({
                     type: 'POST',
                     url: "{{ route('front.user-document.user-document-email-share-save')}}",
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
                         $("#userDocMsgConId").removeClass("hide");
                         $("#userDocMsgConId").removeClass("alert-danger");
                         $("#userDocMsgConId").addClass("alert-success");
                         $("#userDocMsgConId").addClass("show");
                         $("#userDocMsgConId").html(data.message);

                         setTimeout(function() {
                             $("#userDocMsgConId").removeClass("show");
                             $("#userDocMsgConId").addClass("hide");
                         }, 3000);

                     },
                     error: function(data) {
                         var jsonData = $.parseJSON(data.responseText);
                         $("#userDocMsgConId").removeClass("hide");
                         $("#userDocMsgConId").removeClass("alert-success");
                         $("#userDocMsgConId").addClass("alert-danger");
                         $("#userDocMsgConId").addClass("show");
                         $("#userDocMsgConId").html(jsonData.message);

                         setTimeout(function() {
                             $("#userDocMsgConId").removeClass("show");
                             $("#userDocMsgConId").addClass("hide");
                         }, 3000);
                     }
                 });

             } else if (share_type == 2) {


                 e.preventDefault();
                 var formData = new FormData($("#user_document_share_link_form_id")[0]);
                 $.ajax({
                     type: 'POST',
                     url: "{{ route('front.user-document.user-document-link-share-save')}}",
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

             }

         });


         $("#advance_settings_id").click(function() {
             var user_document_id = $("#recent_document_select_item").val();
             alert("{{url('user-document-advance-settings')}}/" + user_document_id);
             window.location.href = "{{url('user-document-advance-settings')}}/" + user_document_id;
         });


         $("#userDocTempConId").addClass("hide");
         $("#document-template-submit-id").click(function() {
             $("#user_document_template_form_id").submit();
         })

         $("#add_recipient_id").click(function() {
             //emailnameFromContId

             $.ajax({
                 url: "{{route('front.check-user-email-form-route')}}",
                 type: "get",
                 dataType: 'json',
                 data: "req_type=check_email_name&email=" + $("#emailid").val() + "&name=" + $("#nameid").val(),
                 success: function(response_html) {
                     if (response_html.return_type == "error") {

                         $("#emailnameFromContId").removeClass("hide");
                         $("#emailnameFromContId").removeClass("alert-success");
                         $("#emailnameFromContId").addClass("alert-danger");
                         $("#emailnameFromContId").addClass("show");
                         $("#emailnameFromContId").html(response_html.message);
                         setTimeout(function() {
                             $("#emailnameFromContId").removeClass("show");
                             $("#emailnameFromContId").addClass("hide");
                         }, 3000);

                     } else {

                         var user_email_info_index = $("#user_email_info_index").val();

                         $("#recipient_container_id").append("<input type='hidden' name='user_email[" + user_email_info_index + "]' value='" + $("#emailid").val() + "' /><input type='hidden' name='user_name[" + user_email_info_index + "]' value='" + $("#nameid").val() + "' />");

                         user_email_info_index += 1;
                         $("#user_email_info_index").val(user_email_info_index);
                     }
                 }

             });

         });

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