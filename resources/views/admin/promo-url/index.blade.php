@extends('layouts.admin')
@section('title',($title ?? ''))
@section('heading',($heading ?? ''))
@section('breadcrumb',($breadcrumb ?? ''))
@section('add_css_heading',($add_css_heading ?? ''))
@section('content')
<!-- Main content -->
<section class="content">
	<!-- Info boxes -->
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-body">
					<!-- begin:: Content -->
					@include('admin.datatable.table')
					<!-- end:: Content -->

				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>

	</div>
	<!-- /.row -->

</section>
<!-- Modal -->
<div class="modal fade promo-url" id="promoUrl" tabindex="-1" role="dialog" aria-labelledby="promoUrlLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="promoUrlLabel">Promo URL</h4>
			</div>
			<div class="modal-body pb-3">
				<div class="input-group">
					<input type="text" id="copy-input" readonly value="">
					<span class="input-group-button">
						<button class="btn" type="button" data-clipboard-demo="" data-clipboard-target="#copy-input">
							<i class="fa fa-copy"></i>
						</button>
					</span>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection
@section('additionaljs')
<script src='https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js'></script>
<script>
	$(document).on('click', '.show_promo_url', function(e) {
		e.preventDefault();
		var url = $(this).attr('data-link');
		$('#copy-input').val(url);
		$('#promoUrl').modal();
	})
	// demos.js

	var clipboardDemos = new Clipboard('[data-clipboard-demo]');

	clipboardDemos.on('success', function(e) {
		e.clearSelection();

		console.info('Action:', e.action);
		console.info('Text:', e.text);
		console.info('Trigger:', e.trigger);

		showTooltip(e.trigger, 'Copied!');
	});

	clipboardDemos.on('error', function(e) {
		console.error('Action:', e.action);
		console.error('Trigger:', e.trigger);

		showTooltip(e.trigger, fallbackMessage(e.action));
	});

	// tooltips.js

	var btns = document.querySelectorAll('.btn');

	for (var i = 0; i < btns.length; i++) {
		btns[i].addEventListener('mouseleave', clearTooltip);
		btns[i].addEventListener('blur', clearTooltip);
	}

	function clearTooltip(e) {
		e.currentTarget.setAttribute('class', 'btn');
		e.currentTarget.removeAttribute('aria-label');
	}

	function showTooltip(elem, msg) {
		elem.setAttribute('class', 'btn tooltipped tooltipped-s');
		elem.setAttribute('aria-label', msg);
	}
</script>
@append