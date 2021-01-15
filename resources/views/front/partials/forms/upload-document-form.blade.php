<div class="modal fade more-options add-new-document" id="add-new-document" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="share-by">
                    <ul class="nav nav-tabs">
                        <li>
                            <a class="active" data-toggle="tab" href="#document-upload"><img src="{{ asset('public/front/images/upload-docs.svg') }}"> Upload Document</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#document-url"><img src="{{ asset('public/front/images/link-red.svg') }}"> Get Document from URL</a>
                        </li>
                    </ul>

                    <div class="tab-content mt-4">

                        <div id="document-upload" class="tab-pane fade in active show">
                            <div id="dropzone">
                                {{ Form::open(['url' => '#','method'=>'post','class'=>'dropzone needsclick','id' => 'upload-document-form','enctype'=>"multipart/form-data"]) }}
                                <div class="dz-message needsclick">
                                    <img src="{{ asset('public/front/images/upload-from-device.svg') }}">
                                    <span>Select From Device</span>
                                </div>
                                {{ Form::close() }}
                                <div class="upload-conditions">
                                    Upload documents of up to 20 MB in .pdf formats
                                </div>
                            </div>
                        </div>

                        <div id="document-url" class="tab-pane fade">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="upload-doc-from-url">
                                        <img src="{{ asset('public/front/images/upload-doc-from-url.svg') }}">
                                        <h6>Upload Document from URL</h6>
                                        <p>Insert an URL to a PDF, document, image up to 25 MB and upload it directly to PDF Writer.</p>
                                    </div>
                                    <div class="form-group row">
                                        <div class=" col-md-8">
                                            <input type="text" class="form-control" id="document-link-url" value="" placeholder="https://example.com">
                                        </div>
                                        <div class="col-md-4">
                                            <button class="btn btn-danger" id="get-document-file">Get File</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="share-link-btns">
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-success" id="modal-done" data-dismiss="modal">Done</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section("additionaljs")
<script>
    var myDropzoneTheSecond = new Dropzone(
        '#upload-document-form', {
            // addRemoveLinks: true,
            url: "{{ route('front.upload-new-document')}}",
            init: function() {
                this.on("sending", function(file, xhr, formData) {
                    formData.append("type", "{{config('constant.DOCUMENT_TYPE_FILE')}}");
                    console.log(formData)
                });
            },
            success: function(file, response) {
                $('#modal-done').addClass('reload-page');
                toastr.success(response.message);
            },
            error: function(file, response) {
                if (response.errors['file'][0].length > 0) {
                    var error_message = response.errors.file[0];
                } else {
                    var error_message = response.message;
                }
                var msgEl = $(file.previewElement).find('.dz-error-message');
                msgEl.text(error_message);
                msgEl.show();
                msgEl.css("opacity", 1);
                console.log(response);
                toastr.error(error_message);
            }
        }
    );
    $(document).on('click', '.reload-page', function(e) {
        e.preventDefault();
        location.reload();
    })
    $(document).on('click', '#get-document-file', function(e) {
        e.preventDefault();
        blockUI();
        var url = $('#document-link-url').val();
        if (url.length > 0) {
            $.ajax({
                url: "{{route('front.get-url-document')}}",
                type: "post",
                dataType: 'json',
                data: {
                    "_token": csrf_token,
                    type: "{{config('constant.DOCUMENT_TYPE_FILE')}}",
                    url: url,
                },
                success: function(result) {
                    location.reload();
                },
                error: function(result, status, errorThrown) {
                    var response = result.responseJSON;
                    if (response.errors['url'][0].length > 0) {
                        var error_message = response.errors.url[0];
                    } else {
                        var error_message = response.message;
                    }
                    toastr.error(error_message);
                },
                complete: function() {
                    $.unblockUI();
                }
            });
        } else {
            toastr.error("Enter valid file url");
        }

    });
</script>
@append