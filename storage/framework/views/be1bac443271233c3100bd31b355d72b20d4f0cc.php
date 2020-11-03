<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
	<!--Begin::Dashboard 3-->

	<!--Begin::Section-->
	<div class="row">
		<div class="col-md-12"> 
			<!--begin::Portlet-->
			<div class="kt-portlet">
				<!--begin::Form-->
				<form class="kt-form">
					<div class="kt-portlet">
						<div class="row">
							<div class="form-group validated col-lg-12">
								<div class="kt-portlet__body">
									<table class="table table-bordered table-striped" id="laravel_datatable">
										<thead>
											<tr>
												<?php $__currentLoopData = $data_table['data_column_config']['columns']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<th>
													<?php echo e((array_key_exists('label',$column) ? $column['label'] : '')); ?>

												</th>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>
					</div>
				</form>
				<!--end::Form-->
			</div>
			<!--end::Portlet-->
		</div>
	</div>
</div>
<?php $__env->startSection('additionaljs'); ?>
<script src="<?php echo e(asset('public/admin/plugins/jQueryDatatable/jquery.dataTables.min.js')); ?>"></script>
<script>
	var statusFilterView = '<?php echo $data_table["status_filter_view"] ?? ""; ?>';
	var sourceUrl = '<?php echo e($data_table["data_source"]); ?>';
	var columnsList = '<?php echo json_encode($data_table["data_column_config"]["columns"]); ?>';
	var order = '<?php echo json_encode($data_table["data_column_config"]["order"]); ?>';
	$(document).ready( function () {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		var table = $('#laravel_datatable').DataTable({
			processing: true,
			serverSide: true,
			ajax: {
				url: sourceUrl,
				type: 'GET',
				data: function (d){
					d.statusFilter = $("#status_dropdown").val();	                   		
					d.frm_id=$("#top_id").val();
				},
				beforeSend: function() {
					blockUI();
				},
				complete: function(response) {
					console.log(response);
					unblockUI();
				}
			},
			columns: JSON.parse(columnsList),
			order: JSON.parse(order)
		});
		if(statusFilterView.length > 0){
			$(statusFilterView).appendTo("#laravel_datatable_wrapper .dataTables_filter");
		}

		// $(document).on('change','#status_dropdown',function(){
		// 	table.draw();
		// });

		// $('#searchForm').on('submit', function(e) {
		// 	e.preventDefault();
		// 	table.draw();
		// });
	});	
</script>
<?php $__env->appendSection(); ?><?php /**PATH /var/www/html/pdf-writer/resources/views/admin/top100form/faq/table.blade.php ENDPATH**/ ?>