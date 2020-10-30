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
									<div class="table-responsive">
										<table class="table table-bordered table-striped" id="laravel_datatable">
											<thead>
												<tr>
													@foreach($data_table['data_column_config']['columns'] as $column)
													<th>
														{{ (array_key_exists('label',$column) ? $column['label'] : '') }}
													</th>
													@endforeach
												</tr>
											</thead>
										</table>
									</div>
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
@section('additionaljs')
<script src="{{ asset('public/admin/plugins/jQueryDatatable/jquery.dataTables.min.js') }}"></script>
<script>
	var statusFilterView = '{!! $data_table["status_filter_view"] ?? "" !!}';
	var sourceUrl = '{{ $data_table["data_source"] }}';
	var columnsList = '{!! json_encode($data_table["data_column_config"]["columns"]) !!}';
	var order = '{!! json_encode($data_table["data_column_config"]["order"]) !!}';
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
					d.statusFilter = $("#status_dropdown").val()
				},
				beforeSend: function() {
					blockUI();
				},
				complete: function(response) {
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
@append