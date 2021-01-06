@extends('layouts.front-user')
@section('title',($title ?? ''))
@section("content")

<!-- Content Header (Page header) -->
<section class="content-header share-allert">
    <div class="title">
        <h2>LinkToFill</h2>
    </div>
    <div class="share-allert-text">
        <p>Distribute your documents to be filled by anyone on any device. See the options below to choose the best way to distribute your documents and get them completed.</p>
    </div>
</section>

<!-- Main content -->
<section class="content">

    <div class="advance-settings-part">
        <h3>
            <a class="" data-toggle="collapse" href="#you-are-sharing" aria-expanded="true" aria-controls="you-are-sharing">
                <img class="icon" src="{{ asset('public/front/images/file-document-outline.svg') }}"> Document Template to make publicly fillable <span><img src="{{ asset('public/front/images/info-i.svg') }}"></span></a>
        </h3>
        <div class="collapse show" id="you-are-sharing">
            <div class="advance-settings-content">
                <div class="row">
                    <div class="col-lg-10 col-md-8">
                        <div class="single-document single-doc-signed">
                            <div class="doc-dots">
                                <button><i class="fas fa-bars"></i></button>
                            </div>
                            <div class="doc-img">
                                <img src="{{ $document->thumbnail_url }}" class="user-image" alt="{{ $document->formatted_name }}">
                            </div>
                            <div class="doc-content">
                                <h5>{{ $document->formatted_name }}</h5>
                                <div class="last-activity">Last update: {{ changeDateTimeFormat($document->updated_at) }}</div>
                            </div>
                            <!-- <div class="doc-date-and-dismiss">
                                <a href="" class="edit-fillable-btn"><i class="fas fa-edit"></i> Edit Fillable Fields</a>
                                <button><i class="fas fa-times"></i></button>
                            </div> -->
                            <div></div>
                        </div>
                    </div>
                    <!-- <div class="col-lg-2 col-md-4">
                        <div class="add-single-doc-signed">
                            <a href=""><i class="fas fa-plus-circle"></i> Add Another Document</a>
                        </div>
                    </div> -->
                </div>
            </div>

            <section class="general-settings-tabs linktofill-settings">
                <h4 class="active">
                    <div class="d-flex align-items-center">
                        <div class="tab-icon"><img src="{{ asset('public/front/images/security.svg') }}"></div>
                        <div class="tab-content">
                            <span>Set Security Options</span>
                            <p>Define Security Settings</p>
                        </div>
                        <div class="tab-info">
                            <img src="{{ asset('public/front/images/info-i.svg') }}">
                        </div>
                    </div>
                </h4>
                <div class="setting-tab-content">
                    <div class="security-options">
                        <div class="single-security-options">
                            <div class="title">Password Protection
                                <span class="tab-info">
                                    <img src="{{ asset('public/front/images/info-i.svg') }}">
                                </span>
                            </div>
                            <div class="other-options"><button class="set-password"><i class="fas fa-key"></i> Set Password</button></div>
                        </div>
                        <div class="single-security-options">
                            <div class="title">HIPAA Compliance
                                <span class="tab-info">
                                    <img src="{{ asset('public/front/images/info-i.svg') }}">
                                </span>
                            </div>
                            <div class="other-options">
                                <div class="tg-list-item">
                                    <input class="tgl tgl-light" id="cb0" type="checkbox" />
                                    <label class="tgl-btn" for="cb0"></label>
                                </div>

                            </div>
                        </div>

                        <div class="single-security-options">
                            <div class="title">Document ID
                                <span class="tab-info">
                                    <img src="{{ asset('public/front/images/info-i.svg') }}">
                                </span>
                            </div>
                            <div class="other-options">
                                <div class="tg-list-item">
                                    <input class="tgl tgl-light" id="cb1" type="checkbox" />
                                    <label class="tgl-btn" for="cb1"></label>
                                </div>

                            </div>
                        </div>

                        <div class="single-security-options">
                            <div class="title">Public Access Expires
                                <span class="tab-info">
                                    <img src="{{ asset('public/front/images/info-i.svg') }}">
                                </span>
                            </div>
                            <div class="other-options">
                                <div class="tg-list-item">
                                    <input class="tgl tgl-light" id="cb2" type="checkbox" />
                                    <label class="tgl-btn" for="cb2"></label>
                                </div>

                            </div>
                            <div class="other-options ml-20">
                                <input type="text" class="form-control mw-150 calendar">

                            </div>
                        </div>

                        <div class="single-security-options">
                            <div class="title">Select Date
                                <span class="tab-info">
                                    <img src="{{ asset('public/front/images/info-i.svg') }}">
                                </span>
                            </div>
                            <div class="other-options">
                                <div class="tg-list-item">
                                    <input class="tgl tgl-light" id="cb3" type="checkbox" />
                                    <label class="tgl-btn" for="cb3"></label>
                                </div>

                            </div>
                        </div>

                        <div class="single-security-options">
                            <div class="title">Electronic record and signature disclosure
                                <span class="tab-info">
                                    <img src="{{ asset('public/front/images/info-i.svg') }}">
                                </span>
                            </div>
                            <div class="other-options">
                                <div class="tg-list-item">
                                    <input class="tgl tgl-light" id="cb4" type="checkbox" />
                                    <label class="tgl-btn" for="cb4"></label>
                                </div>

                            </div>
                        </div>

                        <div class="single-security-options">
                            <div class="title">Signature Agreement
                                <span class="tab-info">
                                    <img src="{{ asset('public/front/images/info-i.svg') }}">
                                </span>
                            </div>
                            <div class="other-options">
                                <div class="tg-list-item">
                                    <input class="tgl tgl-light" id="cb5" type="checkbox" />
                                    <label class="tgl-btn" for="cb5"></label>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <h4>
                    <div class="d-flex align-items-center">
                        <div class="tab-icon"><img src="{{ asset('public/front/images/require-from-recipient.svg') }}"></div>
                        <div class="tab-content">
                            <span>Require from Recipient</span>
                            <p>Verify Recipient Identity</p>
                        </div>
                        <div class="tab-info">
                            <img src="{{ asset('public/front/images/info-i.svg') }}">
                        </div>
                    </div>
                </h4>
                <div class="setting-tab-content">
                    <div class="security-options">
                        <div class="single-security-options">
                            <div class="title">Email Address
                            </div>
                            <div class="other-options">
                                <div class="tg-list-item">
                                    <input class="tgl tgl-light" id="ab0" type="checkbox" />
                                    <label class="tgl-btn" for="ab0"></label>
                                </div>

                            </div>
                        </div>

                        <div class="single-security-options">
                            <div class="title">Name
                            </div>
                            <div class="other-options">
                                <div class="tg-list-item">
                                    <input class="tgl tgl-light" id="ab1" type="checkbox" />
                                    <label class="tgl-btn" for="ab1"></label>
                                </div>
                            </div>
                        </div>

                        <div class="single-security-options">
                            <div class="title">Authantication Method
                                <span class="tab-info">
                                    <img src="{{ asset('public/front/images/info-i.svg') }}">
                                </span>
                            </div>
                            <div class="other-options">
                                <div class="authentication-method-disc">
                                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                        <input type="checkbox" class="custom-control-input" id="checkbox-1">
                                        <label class="custom-control-label" for="checkbox-1">Phone Number </label>
                                    </div>
                                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                        <input type="checkbox" class="custom-control-input" id="checkbox-2">
                                        <label class="custom-control-label" for="checkbox-2">Social Media <span class="fb"><i class="fab fa-facebook-f"></i></span> <span class="google"><img src="{{ asset('/public/front/images/google_g.svg') }}"></span></label>
                                    </div>
                                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                        <input type="checkbox" class="custom-control-input" id="checkbox-3">
                                        <label class="custom-control-label" for="checkbox-3">Photo</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="single-security-options">
                            <div class="title">Authanticational Documents
                                <span class="tab-info">
                                    <img src="{{ asset('public/front/images/info-i.svg') }}">
                                </span>
                            </div>
                            <div class="other-options">
                                <div class="add-document-names">
                                    <div class="add-tag-input">
                                        <input type="text" class="form-control" placeholder="Add document name">
                                        <button><i class="fas fa-plus"></i></button>
                                    </div>
                                    <div class="tags-list">
                                        <span class="tag">My docs <span data-role="remove"></span></span>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <h4>
                    <div class="d-flex align-items-center">
                        <div class="tab-icon"><img src="{{ asset('public/front/images/user-card.svg') }}"></div>
                        <div class="tab-content">
                            <span>Create a Welcome Message and Set Redirect</span>
                            <p>Introduce Yourself to Recipients</p>
                        </div>
                        <div class="tab-info">
                            <img src="{{ asset('public/front/images/info-i.svg') }}">
                        </div>
                    </div>
                </h4>
                <div class="setting-tab-content">
                    <div class="security-options">
                        <div class="single-security-options personalize-invitation-part">
                            <div class="title">Your Logo</div>
                            <div class="other-options">
                                <div class="personalize-invitation-content">
                                    <p>Replace the default PDF Writer logo with your own (optional).</p>
                                    <ul class="template-types logo-type">
                                        <!-- <li class="position-relative">
                                                        <div class="upload-your-logo">
                                                            <img src="{{ asset('public/front/images/add-new-logo.png') }}">
                                                            <input type="file">
                                                        </div>
                                                    </li> -->
                                        <li class="p-0">
                                            <div id="UploadLogo">
                                                <upload-gambar></upload-gambar>
                                            </div>
                                        </li>
                                        <li>
                                            <img src="{{ asset('public/front/images/logo-blue.png') }}">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="single-security-options personalize-invitation-part">
                            <div class="title">Welcome Message</div>
                            <div class="other-options w-100">
                                <div class="form-group">
                                    <textarea class="form-control w-100" placeholder="Please make sure that all information in this document is correct before submitting. If you have any questions about using PDF Writer, please click the question mark."></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="single-security-options personalize-invitation-part">
                            <div class="title">Your Business Card</div>
                            <div class="other-options w-100">

                                <div class="row">
                                    <div class="col-lg-12 col-xl-4">
                                        <div class="avatar-upload">
                                            <div class="avatar-preview">
                                                <div id="imagePreview" style="background-image: url({{ asset('public/front/images/avatar.svg') }});">
                                                </div>
                                            </div>
                                            <div class="avatar-edit">
                                                <input type='file' id="imageUpload" accept=".png') }}, .jpg, .jpeg" />
                                                <label for="imageUpload">Add Picture</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-xl-8">
                                        <div class="personalize-invitation-content">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="First Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Last Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Job Title">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Company">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="johnsmith@gmail.com">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Phone number">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Fax Number">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Website">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="single-security-options">
                            <div class="title">Introduction Video (URL)</div>
                            <div class="other-options w-100">
                                <div class="form-group">
                                    <input class="form-control w-100" placeholder="https://">
                                </div>
                            </div>
                        </div>

                        <div class="single-security-options">
                            <div class="title">Redirect After Submission
                                <span class="tab-info">
                                    <img src="{{ asset('public/front/images/info-i.svg') }}">
                                </span>
                            </div>
                            <div class="other-options w-100">
                                <div class="form-group">
                                    <input class="form-control w-100" placeholder="Http://www.pdfwriter.com">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h4>
                    <div class="d-flex align-items-center">
                        <div class="tab-icon"><img src="{{ asset('public/front/images/access-privilege.svg') }}"></div>
                        <div class="tab-content">
                            <span>Set Signing and Access Privilege</span>
                            <p>Customize Access to Your Document</p>
                        </div>
                        <div class="tab-info">
                            <img src="{{ asset('public/front/images/info-i.svg') }}">
                        </div>
                    </div>
                </h4>
                <div class="setting-tab-content">
                    <div class="security-options">
                        <div class="single-security-options personalize-invitation-part">
                            <div class="title">User Can</div>
                            <div class="other-options">
                                <div class="personalize-invitation-content mb-0">
                                    <ul class="template-types">
                                        <li>
                                            <span>Edit & Sign</span>
                                        </li>
                                        <li>
                                            <span>Sign Only</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="single-security-options">
                            <div class="title">Enforce Required Fields</div>
                            <div class="other-options">
                                <div class="tg-list-item">
                                    <input class="tgl tgl-light" id="bb1" type="checkbox" />
                                    <label class="tgl-btn" for="bb1"></label>
                                </div>

                            </div>
                        </div>

                        <div class="single-security-options">
                            <div class="title">Signature Stamp
                                <span class="tab-info">
                                    <img src="{{ asset('public/front/images/info-i.svg') }}">
                                </span>
                            </div>
                            <div class="other-options">
                                <div class="tg-list-item">
                                    <input class="tgl tgl-light" id="bb2" type="checkbox" />
                                    <label class="tgl-btn" for="bb2"></label>
                                </div>

                            </div>
                        </div>

                        <div class="single-security-options">
                            <div class="title">Can get a copy
                                <span class="tab-info">
                                    <img src="{{ asset('public/front/images/info-i.svg') }}">
                                </span>
                            </div>
                            <div class="other-options">
                                <div class="tg-list-item">
                                    <input class="tgl tgl-light" id="bb3" type="checkbox" />
                                    <label class="tgl-btn" for="bb3"></label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <h4>
                    <div class="d-flex align-items-center">
                        <div class="tab-icon"><img src="{{ asset('public/front/images/bell.svg') }}"></div>
                        <div class="tab-content">
                            <span>Complete Document Notification and Storage</span>
                            <p>Stay in the Loop</p>
                        </div>
                        <div class="tab-info">
                            <img src="{{ asset('public/front/images/info-i.svg') }}">
                        </div>
                    </div>
                </h4>
                <div class="setting-tab-content">
                    <div class="security-options">
                        <div class="single-security-options personalize-invitation-part">
                            <div class="title">Send Notification to</div>
                            <div class="other-options">
                                <div class="add-document-names">
                                    <div class="add-tag-input">
                                        <input type="text" class="form-control" placeholder="Add email address">
                                        <button><i class="fas fa-plus"></i></button>
                                    </div>
                                    <div class="tags-list">
                                        <span class="tag">johnsmith@gmail.com <span data-role="remove"></span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="other-options ml-20">
                                <button class="btn address-book-btn"><i class="fas fa-address-book"></i> Address Book</button>

                            </div>
                        </div>

                        <div class="single-security-options">
                            <div class="title">Attach Document</div>
                            <div class="other-options">
                                <div class="tg-list-item">
                                    <input class="tgl tgl-light" id="db1" type="checkbox" />
                                    <label class="tgl-btn" for="db1"></label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <h3>
            <a class="" data-toggle="collapse" href="#recipients" aria-expanded="true" aria-controls="recipients">
                <img class="icon" src="{{ asset('public/front/images/file-document-outline.svg') }}"> Distribute your Document
                <span>
                    <img src="{{ asset('public/front/images/info-i.svg') }}">
                </span>
            </a>
        </h3>
        <div class="collapse show" id="recipients">
            <div class="advance-settings-content disable-div">
                <div class="share-by">
                    <div class="tab-content">
                        <div class="row">
                            <div class="col-md-12">
                                <p>This URL will open your document in any desktop or mobile browser. Use this link to access and share your document.</p>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Http://">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <ul class="generate-url-btns">
                                    <li><a class="outline-btn mb-3" href=""><i class="far fa-copy"></i> Copy Link</a></li>
                                </ul>
                            </div>

                            <div class="col-md-12">
                                <p>Post your document's URL on Facebook or Twitter</p>
                            </div>
                            <div class="col-md-12">
                                <ul class="generate-url-btns">
                                    <li><a class="facebook" href=""><i class="fab fa-facebook-f"></i> Share on Facebook</a></li>
                                    <li><a class="twitter" href=""><i class="fab fa-twitter"></i> Share on Twitter</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="advance-settings-btns d-inline-block">
            <a href="#" class="share-btn">Publish</a>
            <a href="#" class="my-doc-btn">My Docs</a>
            <div class="d-inline-block ml-3">
                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                    <input type="checkbox" class="custom-control-input" id="checkbox-4">
                    <label class="custom-control-label" for="checkbox-4">Use as your default LinkToFill settings</label>
                </div>
            </div>

            <!-- <a href="#" class="btn btn-outline-success float-right">Test My Document</a> -->
        </div>

    </div>

</section>
<!-- /.content -->
@endsection
@section('additionaljs')
<script>
    ///////////// Image Upload and Preview /////////////
    Vue.component('upload-gambar', {
        template: `
  <span @click="openUpload">
  	<img ref="preview" :src="showImage" style="max-width: 200px; max-height: 70px">
    <input ref="input" @change="previewImage" type="file" id="file-field" accept="image/*" style="display: none"/>
  </span>`,

        data: () => {
            return {
                showImage: "{{ asset('public/front/images/add-new-logo.png') }} "
            }
        },

        methods: {
            openUpload() {
                this.$refs.input.click()
            },

            previewImage() {
                var reader = new FileReader()
                reader.readAsDataURL(this.$refs.input.files[0])

                reader.onload = e => {
                    this.showImage = e.target.result
                }
            }
        }
    });

    new Vue({
        el: '#UploadLogo'
    })
</script>
@append