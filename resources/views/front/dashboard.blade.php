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
		<div class="position-relative">
			<button class="btn btn-success addnew-btn"><i class="fas fa-plus"></i> Add New</button>
			<div class="addnew-dropdown">
				<div class="addnew-body">
					<h5>Upload or Create</h5>
					<div class="shareable-links">
						<ul>
							<li>
								<a href="#" data-toggle="modal" data-target="#add-new-document">
									<div class="link-img"><img src="{{ asset('public/front/images/upload.svg') }}"></div>
									<span>Upload Document</span>
								</a>
							</li>
							<li>
								<a href="#" data-toggle="modal" data-target="#add-new-template">
									<div class="link-img"><img src="{{ asset('public/front/images/upload-template.svg') }}"></div>
									<span>Upload Template</span>
								</a>
							</li>
							<li>
								<a href="#">
									<div class="link-img"><img src="{{ asset('public/front/images/create-document.svg') }}"></div>
									<span>Create Document</span>
								</a>
							</li>
							<li>
								<a href="#" data-toggle="modal" data-target="#add-new-folder">
									<div class="link-img"><img src="{{ asset('public/front/images/new-folder.svg') }}"></div>
									<span>New Folder</span>
								</a>
							</li>
						</ul>
						<!-- <ul>
							<li>
								<a href="#">
									<div class="link-img"><img src="{{ asset('public/front/images/upload.svg') }}"></div>
									<span>Upload Document</span>
								</a>
							</li>
							<li>
								<a href="#" id="upload_template_id" data-toggle="modal" data-target="#user_template_model">
									<div class="link-img"><img src="{{ asset('public/front/images/upload-template.svg') }}"></div>
									<span>Upload Template</span>
								</a>
							</li>
							<li>
								<a href="#">
									<div class="link-img"><img src="{{ asset('public/front/images/create-document.svg') }}"></div>
									<span>Create Document</span>
								</a>
							</li>
							<li>
								<a href="#">
									<div class="link-img"><img src="{{ asset('public/front/images/new-folder.svg') }}"></div>
									<span>New Folder</span>
								</a>
							</li>
						</ul> -->
					</div>
					<h5>Search Our Libraries</h5>
					<div class="searchwith-legalform">
						<div class="input-group input-group-joined input-group-solid ml-3">
							<input class="form-control mr-sm-0" type="search" placeholder="Search" aria-label="Search">
							<div class="input-group-append">
								<button class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
										<circle cx="11" cy="11" r="8"></circle>
										<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
									</svg></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>



		<div class="input-group input-group-joined input-group-solid ml-3">
			<input class="form-control mr-sm-0" type="search" placeholder="Search" aria-label="Search">
			<div class="input-group-append">
				<button class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
						<circle cx="11" cy="11" r="8"></circle>
						<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
					</svg></button>
			</div>
		</div>
	</div>
</section>
<div class="tab-content" id="myTabContent">
	<div class="tab-pane fade show active" id="document" role="tabpanel" aria-labelledby="document-tab">
		<!-- Main content -->
		<section class="content">
			<div class="recent-documents">
				<h4>Recent Documents</h4>
			</div>
			<input type="hidden" name="recent_document_select_item" id="recent_document_select_item" value="0" />
			@foreach($recent_documents as $row)
			<div class="single-document" data-id="{{ $row->encrypted_id }}">
				<div class="doc-img">
					<img src="{{ $row->thumbnail_url }}" class="user-image" alt="{{ $row->formatted_name }}">
				</div>
				<div class="doc-content">
					<h5>{{ $row->formatted_name }}</h5>
					<div class="last-activity">Last activity: <strong>You opened {{ $row->name }}</strong></div>
					<dtv class="tags">
						<span class="tag badge badge-warning">GuideBook</span>
						<a href="" class="add-tag">
							<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
								<g>
									<g>
										<path d="M256,0C114.833,0,0,114.833,0,256s114.833,256,256,256s256-114.853,256-256S397.167,0,256,0z M256,472.341 c-119.275,0-216.341-97.046-216.341-216.341S136.725,39.659,256,39.659S472.341,136.705,472.341,256S375.295,472.341,256,472.341z " />
									</g>
								</g>
								<g>
									<g>
										<path d="M355.148,234.386H275.83v-79.318c0-10.946-8.864-19.83-19.83-19.83s-19.83,8.884-19.83,19.83v79.318h-79.318 c-10.966,0-19.83,8.884-19.83,19.83s8.864,19.83,19.83,19.83h79.318v79.318c0,10.946,8.864,19.83,19.83,19.83 s19.83-8.884,19.83-19.83v-79.318h79.318c10.966,0,19.83-8.884,19.83-19.83S366.114,234.386,355.148,234.386z" />
									</g>
								</g>
								<g> </g>
								<g> </g>
								<g> </g>
								<g> </g>
								<g> </g>
								<g> </g>
								<g> </g>
								<g> </g>
								<g> </g>
								<g> </g>
								<g> </g>
								<g> </g>
								<g> </g>
								<g> </g>
								<g> </g>
							</svg> Add tag
						</a>
					</dtv>
				</div>
				<div class="doc-date-and-dismiss">
					<div class="doc-date">
						<i class="fas fa-calendar-day"></i> {{ changeDateTimeFormat($row->updated_at) }}
					</div>
					<button><i class="fas fa-ellipsis-v"></i></button>
				</div>
			</div>
			@endforeach
			<!-- <div class="single-document free-trial-document">
				<div class="doc-img">
					<h4><strong>Free</strong> Trial</h4>
				</div>
				<div class="doc-content">
					<h5>Get PDFwriter For FREE. Fill and edit documents Signed.pdf</h5>
					<dtv class="tags">
						<ul>
							<li>Print</li>
							<li>-</li>
							<li>Save as</li>
							<li>-</li>
							<li>Email</li>
							<li>-</li>
							<li>E-Sign</li>
							<li>-</li>
							<li>Fax</li>
							<li>-</li>
							<li>Share</li>
						</ul>
					</dtv>
				</div>
				<div class="doc-date-and-dismiss">
					<div class="start-days-trial">Start 30 Days Free Trial</div>
					<button><i class="fas fa-times"></i></button>
				</div>
			</div> -->
		</section>
		<!-- /.content -->

	</div>
	<div class="tab-pane fade" id="template" role="tabpanel" aria-labelledby="template-tab">
		<!-- Main content -->
		<section class="content">
			<div class="recent-documents">
				<h4>Recent Templates</h4>
			</div>
			@foreach($recent_templates as $row)
			<div class="single-document" data-id="{{ $row->encrypted_id }}" id="document_list_item_<?= $row->id ?>">
				<div class="doc-img">
					<img src="{{ $row->thumbnail_url }}" class="user-image" alt="{{ $row->formatted_name }}">

				</div>
				<div class="doc-content">
					<h5>{{ $row->formatted_name }}</h5>
					<div class="last-activity">Last activity: <strong>You opened {{ $row->name }}</strong></div>
					<dtv class="tags">
						<span class="tag badge badge-warning">GuideBook</span>
						<a href="" class="add-tag">
							<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
								<g>
									<g>
										<path d="M256,0C114.833,0,0,114.833,0,256s114.833,256,256,256s256-114.853,256-256S397.167,0,256,0z M256,472.341 c-119.275,0-216.341-97.046-216.341-216.341S136.725,39.659,256,39.659S472.341,136.705,472.341,256S375.295,472.341,256,472.341z " />
									</g>
								</g>
								<g>
									<g>
										<path d="M355.148,234.386H275.83v-79.318c0-10.946-8.864-19.83-19.83-19.83s-19.83,8.884-19.83,19.83v79.318h-79.318 c-10.966,0-19.83,8.884-19.83,19.83s8.864,19.83,19.83,19.83h79.318v79.318c0,10.946,8.864,19.83,19.83,19.83 s19.83-8.884,19.83-19.83v-79.318h79.318c10.966,0,19.83-8.884,19.83-19.83S366.114,234.386,355.148,234.386z" />
									</g>
								</g>
								<g> </g>
								<g> </g>
								<g> </g>
								<g> </g>
								<g> </g>
								<g> </g>
								<g> </g>
								<g> </g>
								<g> </g>
								<g> </g>
								<g> </g>
								<g> </g>
								<g> </g>
								<g> </g>
								<g> </g>
							</svg> Add tag
						</a>
					</dtv>
				</div>
				<div class="doc-date-and-dismiss">
					<div class="doc-date">
						<i class="fas fa-calendar-day"></i> {{ changeDateTimeFormat($row->updated_at) }}
					</div>
					<button><i class="fas fa-ellipsis-v"></i></button>
				</div>
			</div>
			@endforeach
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