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
@include('front.partials.forms.upload-document-form')
@include('front.partials.forms.upload-template-form')
@include('front.partials.forms.add-folder-form')
@include('front.partials.forms.rename-document-form')