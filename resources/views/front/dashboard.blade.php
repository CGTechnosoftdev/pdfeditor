@extends('layouts.front-user')
@section('title',($title ?? ''))
@section("content")

<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="title">
		<h2>Dashboard</h2>
		<span>Your last login: Nov 11, 2020 at 11:32 pm</span>
	</div>
	<div class="heading-btns">
		<ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="document-tab" data-toggle="tab" href="#document" role="tab" aria-controls="document" aria-selected="true">Document</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="template-tab" data-toggle="tab" href="#template" role="tab" aria-controls="template" aria-selected="false">Templates</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="notification-tab" data-toggle="tab" href="#notification" role="tab" aria-controls="notification" aria-selected="false">Notifications</a>
			</li>
		</ul>
		@include('front.partials.forms.add-new-dropdown')



		<!-- <div class="input-group input-group-joined input-group-solid ml-3">
			<input class="form-control mr-sm-0" type="search" placeholder="Search" aria-label="Search">
			<div class="input-group-append">
				<button class="input-group-text">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
						<circle cx="11" cy="11" r="8"></circle>
						<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
					</svg>
				</button>
			</div>
		</div> -->
	</div>
</section>
<div class="tab-content" id="myTabContent">
	<div class="tab-pane fade show active" id="document" role="tabpanel" aria-labelledby="document-tab">
		<!-- Main content -->
		<section class="content">
			<div class="recent-documents">
				<h4>Recent Documents</h4>
			</div>

			<div id="document_list_containerid">
				@include('front.user-document.items-without-checkbox',['documents'=>$recent_documents,'item_container_id' => 'move_to_trash_document_trigger_'])
			</div>

		</section>
		<!-- /.content -->

	</div>
	<div class="tab-pane fade" id="template" role="tabpanel" aria-labelledby="template-tab">
		<!-- Main content -->
		<section class="content">
			<div class="recent-documents">
				<h4>Recent Templates</h4>
			</div>
			<div id="template_list_containerid">
				@include('front.user-document.items-without-checkbox',['documents'=>$recent_templates,'item_container_id' => 'move_to_trash_template_trigger_'])
			</div>
		</section>
	</div>
	<div class="tab-pane fade" id="notification" role="tabpanel" aria-labelledby="notification-tab">
		<!-- Main content -->
		<section class="content">
			<div class="recent-documents">
				<h4>Tab 3</h4>
			</div>
		</section>
	</div>
</div>
<!-- /.content -->
@endsection