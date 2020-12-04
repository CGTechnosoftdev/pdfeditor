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
@php
$paggingArray = config('custom_config.paging_limit_arr');
@endphp
<link href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
<script src="{{ asset('public/admin/plugins/jQueryDatatable/jquery.dataTables.min.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script>
	var filterView = '{!! $data_table["filter_view"] ?? "" !!}';
	var sourceUrl = '{{ $data_table["data_source"] }}';
	var columnsList = '{!! json_encode($data_table["data_column_config"]["columns"]) !!}';
	var order = '{!! json_encode($data_table["data_column_config"]["order"]) !!}';
	var lengthMenuKey = JSON.parse('{!! json_encode(array_keys($paggingArray)) !!}');
	var lengthMenuValue = JSON.parse('{!! json_encode(array_values($paggingArray)) !!}');
	$(document).ready(function() {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		let init_data = 1;
		var table = $('#laravel_datatable').DataTable({
			processing: true,
			serverSide: true,
			ajax: {
				url: sourceUrl,
				type: 'GET',
				data: function(d) {
					d.rangeFilter = $("#daterange").val()
				},
				beforeSend: function() {
					blockUI();
				},
				complete: function(response) {
					if (init_data == 1) {
						$('#daterange').daterangepicker({
							opens: 'left',
							locale: {
								cancelLabel: 'Clear',
								separator: " to ",
								format: "{{ (config('custom_config.daterangepicker_date_format_arr')[config('general_settings.date_format')]) }}",
							}
						});
						$('#daterange').val('');
						init_data++;
					}
					unblockUI();
				}
			},
			search: {
				"regex": true
			},
			columns: JSON.parse(columnsList),
			language: {
				search: '',
				searchPlaceholder: "Search"
			},
			dom: 'lfBrtip',
			buttons: [{
				"extend": "excel",
				exportOptions: {
					columns: ':visible'
				}
			}],
			order: JSON.parse(order),
			lengthMenu: [
				lengthMenuKey,
				lengthMenuValue
			],
			pageLength: "{{ Auth::user()->general_setting['paging_limit'] }}",
			initComplete: function() {
				var $buttons = $('.dt-buttons').hide();
				$('.exportLink').on('click', function(e) {
					e.preventDefault();
					btnClass = $(this).attr('data-btn');
					if (btnClass) $buttons.find(btnClass).click();
				})
			}
		});
		if (filterView.length > 0) {
			$(filterView).appendTo("#laravel_datatable_wrapper .dataTables_filter");
		}
		$('#daterange').on('apply.daterangepicker', function(ev, picker) {
			table.draw();
		});
		$('#daterange').on('cancel.daterangepicker', function(ev, picker) {
			$(this).val('');
			table.draw();
		});
	});
</script>
@append