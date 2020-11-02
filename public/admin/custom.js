function blockUI(){
	$.blockUI({
		baseZ: 2000
	});
}
function unblockUI(){
	$.unblockUI();
}

/** [create slug function] */
function createSlug(source,target){
	var value = $(source).val();
	var str = value.replace(/[ ]+/g, '-');
	$(target).val(str.toLowerCase());

}

	

jQuery(document).ready(function() {		
	/*** Tool Tip ***/
	$('[data-toggle="tooltip"]').tooltip();

	$(document).on('click','#change-password-checkbox',function(e){
		if ($(this).is(":checked")) {
			$(".change-password-elements").removeAttr("disabled");
		} else {
			$(".change-password-elements").attr("disabled", "disabled");
		}
	});

	$(document).on('click','.change-status',function(e){
		e.preventDefault();
		blockUI();
		var activeClass = true;
		var inactiveClass = false;
		var statusElement=$(this);
		var statusCheckbox=$(this).find('.status_checkbox');
		var type = statusElement.attr('data-type');
		var id = statusElement.attr('data-id');
		var status = statusElement.attr('data-status');
		$.ajax({
	        url: admin_url+"/change-status", //the page containing php script
	        type: "post", //request type,
	        dataType: 'json',
	        data: { "_token": csrf_token,type:type,id:id,status:status},
	        success:function(result){        	
	        	if(result.success){
	        		toastr.success(result.message);
	        		if(result.data=="1"){
	        			statusCheckbox.prop("checked", true);
	        			statusElement.attr("title", 'Active');
	        		}else if(result.data=="2"){
	        			statusCheckbox.prop("checked", false);
	        			statusElement.attr("title", 'Inactive');
	        		}else{

	        		}
	        		statusElement.attr('data-status',result.data);
	        	}else{
	        		toastr.error(result.message);
	        	}
	        },
	        complete:function(){
	        	$.unblockUI();
	        }
	    });
	});
});

/*** Upload and preview image ***/
function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function(e) {
			$('#blah')
			.attr('src', e.target.result);
		};
		reader.readAsDataURL(input.files[0]);
	}
}
