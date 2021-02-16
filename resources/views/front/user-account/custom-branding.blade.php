@extends('layouts.front-user')
@section("title",$title)
@section("content")
<div class="content-container">
    <div class="main-heading">
        <h1>{{$title}}</h1>
        <p>Personalize emails that you send whenever you use SendToSign and Share. Upload your own logo or picture and customize your signature.</p>
    </div>

    <div class="custom_branding_part">
        <div class="row">
            <div class="col-md-6">
                <div class="genrate_custom_branding">
                    <div class="template-brand-info">
                        <h3>Template Style</h3>
                        <ul class="tabs-nav">
                            @foreach($template_style as $template_index => $template_valueArray)
                            <li class="tab-active active">
                                <a href="#tab-{{$template_index+1}}" data-id="{{$template_index}}" id="template_type_{{$template_index}}" class="brand_style">
                                    <img src="{{asset('public/front/images/branding-'.($template_index+1).'.png')}}">
                                    <h4>{{$template_valueArray["caption"]}}</h4>
                                    <!--<input type="radio" id="Upper-Left-Corner" name="Template" value="Upper-Left">-->
                                </a>
                            </li>
                            <!--<a href=" #" data-id="{{$template_index}}">{{$template_valueArray["caption"]}}</a>-->
                            @endforeach


                        </ul>
                    </div>
                    @if(isset($custom_branding_model))
                    {{ Form::model($custom_branding_model,['route' => ['front.custom-branding-save'],'method'=>'post','id'=>'custom-branding-info-update-form','enctype'=>"multipart/form-data","autocomplete" => 'off']) }}
                    @else
                    {{ Form::open(['route' => ['front.custom-branding-save'],'method'=>'post','id'=>'custom-branding-info-update-form','enctype'=>"multipart/form-data","autocomplete" => 'off']) }}
                    @endif
                    <div class="template-brand-info">
                        <h3>Company Logo</h3>
                        <div class="template-company-logo">
                            <div class="template-company-logo-upload">
                                <div class="choose-logo">
                                    <!-- <input type="file" id="dvd_image">-->
                                    {{ Form::file('company_logo', ['id' => 'dvd_image','accept'=>".png, .jpg, .jpeg"]) }}
                                    <img src="{{asset('public/front/images/upload-multiple.svg')}}"> Upload
                                </div>
                            </div>
                            <div class="template-company-logo-info">
                                <h5>Recommended size 150x600 px</h5>
                                <p>Select any JPG, GIF or PNG file under 5 MB.</p>
                            </div>
                        </div>
                    </div>




                    {{Form::hidden("custom_brand_id",$custom_brand_id,["id" => "custom_brand_id"])}}
                    {{Form::hidden("template_style","0",["id" => "template_style_id"])}}
                    <!-- <label for="imageUpload">Add Picture</label>-->


                    <div class="template-brand-info">
                        <h3>Signature</h3>
                        <div class="personalize-invitation-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{Form::text('first_name',(!empty($signature["first_name"])?$signature["first_name"]:""),['placeholder' => 'First Name','id' => 'first_name','class' => 'form-control'])}}

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{Form::text('last_name',(!empty($signature["last_name"])?$signature["last_name"]:""),['placeholder' => 'Last Name','id' => 'last_name','class' => 'form-control'])}}

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{Form::text('title',(!empty($signature["title"])?$signature["title"]:""),['placeholder' => 'title','id' => 'title','class' => 'form-control'])}}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{Form::text('company',(!empty($signature["company"])?$signature["company"]:""),['placeholder' => 'company','id' => 'company','class' => 'form-control'])}}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{Form::text('email',(!empty($signature["email"])?$signature["email"]:""),['placeholder' => 'email','id' => 'email','class' => 'form-control'])}}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{Form::text('phone',(!empty($signature["phone"])?$signature["phone"]:""),['placeholder' => 'Phone','id' => 'phone','class' => 'form-control'])}}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{Form::text('fax',(!empty($signature["fax"])?$signature["fax"]:""),['placeholder' => 'fax','id' => 'fax','class' => 'form-control'])}}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{Form::text('website',(!empty($signature["website"])?$signature["website"]:""),['placeholder' => 'Website','id' => 'website','class' => 'form-control'])}}
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="custom-control custom-checkbox red my-1 mr-sm-2 mb-4">
                                        <!--<input type="checkbox" class="custom-control-input" id="checkbox-1">-->
                                        {{Form::checkbox('is_use_email_template',"1",(( !empty($custom_branding_model->is_use_email_template) && $custom_branding_model->is_use_email_template==1)?true:false),['id' => 'is_use_email_template','class' => "custom-control-input"])}}
                                        <label class="custom-control-label" for="is_use_email_template">Use This Email
                                            Template</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    {!! Form::submit('Done',['class'=>'btn btn-success addnew-btn text-white','id'=>'cust_branding_save_btn']) !!}
                                </div>

                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>






            </div>
            <div class="col-md-6">
                <div class="preview_custom_branding tabs-stage">
                    <h4>Preview</h4>
                    {{Form::hidden("company_logo_url",$company_logo,["id" => "company_logo_url"])}}
                    @foreach($template_viewArray as $templateIndex => $templateView)

                    <div id="tab-{{$templateIndex+1}}" class="tab">
                        <div class="branding-preview brand{{$templateIndex+1}}">
                            <div class="brand-logo">
                                <div class="preview {{(!empty($company_logo)?'':'hide')}}">
                                    <img src="{{$company_logo}}" class="image_to_upload" />
                                </div>
                            </div>
                            <div class="brand-content">
                                <div class="hide" id="emailContainer_{{$templateIndex}}" data-id="{{$templateIndex}}">
                                    {!!$templateView!!}
                                </div>
                                <div class="brand-footer text-left">
                                    <div id="signature_block">
                                        <p class="mb-1" id="signature_firstname_view_{{$templateIndex}}"></p>

                                        <p class="mb-1" id="signature_title_view_{{$templateIndex}}"></p>
                                        <p class="mb-1" id="signature_company_view_{{$templateIndex}}"></p>
                                        <p class="mb-1" id="signature_email_view_{{$templateIndex}}"></p>
                                        <p class="mb-1" id="signature_phone_view_{{$templateIndex}}"></p>
                                        <p class="mb-1" id="signature_fax_view_{{$templateIndex}}"></p>
                                        <p class="mb-1" id="signature_website_view_{{$templateIndex}}"></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    @endforeach

                    {{ Form::open(['route' => ['front.custom-branding-test-email'],'method'=>'post','id'=>'send-test-email-form','enctype'=>"multipart/form-data","autocomplete" => 'off','class' => 'text-right mt-4']) }}
                    {{Form::hidden('signature_first_name','',["id" => 'signature_first_name'])}}
                    {{Form::hidden('signature_last_name','',["id" => 'signature_last_name'])}}
                    {{Form::hidden('signature_title','',["id" => 'signature_title'])}}
                    {{Form::hidden('signature_company','',["id" => 'signature_company'])}}
                    {{Form::hidden('signature_email','',["id" => 'signature_email'])}}
                    {{Form::hidden('signature_phone','',["id" => 'signature_phone'])}}
                    {{Form::hidden('signature_fax','',["id" => 'signature_fax'])}}
                    {{Form::hidden('signature_website','',["id" => 'signature_website'])}}
                    {{Form::hidden("template_style_for_email","0",["id" => "template_style_for_email_id"])}}


                    {!! Form::submit('Send Test Email',['class'=>'btn btn-success addnew-btn','id'=>'custom_branding_test_email_button']) !!}
                    {{ Form::close() }}


                </div>
            </div>
        </div>
    </div>
</div>






@endsection
@section('additionaljs')
{!! JsValidator::formRequest('App\Http\Requests\CustomBrandingFormRequest','#custom-branding-info-update-form') !!}
<script>
    // Show the first tab by default
    $("#company_logo_url_id").attr({
        "src": $("#company_logo_url").val()
    })
    $('.genrate_custom_branding ul li').on('click', function() {
        $(this).addClass('active').siblings().removeClass('active');
    });
    $('.tabs-stage .tab').hide();
    $('.tabs-stage .tab:first').show();
    $('.tabs-nav li:first').addClass('tab-active');

    // Change tab class and display content
    $('.tabs-nav a').on('click', function(event) {
        event.preventDefault();

        $('.tabs-nav li').removeClass('tab-active');
        $(this).parent().addClass('tab-active');
        $('.tabs-stage .tab').hide();
        $($(this).attr('href')).show();
    });

    (function() {
        // Display the image to be uploaded.
        $('#dvd_image').on('change', function(e) {
            return readURL(this);
        });

        this.readURL = function(input) {
            var reader;

            // Read the contents of the image file to be uploaded and display it.

            if (input.files && input.files[0]) {
                reader = new FileReader();
                reader.onload = function(e) {
                    var $preview;
                    $('.image_to_upload').attr('src', e.target.result);
                    $preview = $('.preview');
                    if ($preview.hasClass('hide')) {
                        return $preview.toggleClass('hide');
                    }
                };
                return reader.readAsDataURL(input.files[0]);
            }
        };

    }).call(this);



    $("#template_style_id").val("{{!empty($custom_branding_model->template_style)?$custom_branding_model->template_style:0}}");
    $("#template_style_for_email_id").val("{{!empty($custom_branding_model->template_style)?$custom_branding_model->template_style:0}}");

    $("#emailContainer_" + $("#template_style_id").val()).addClass("show");
    $("#emailContainer_" + $("#template_style_id").val()).removeClass("hide");
    $("div[id ^= 'emailContainer_']").each(function(index, value) {
        var id = $(this).attr("data-id");
        $(this).html($("#emailContainer_" + id + " #email_content_part_id").html());

    });

    function putSignatureinTemplate() {
        var tab_id = parseInt($("#template_style_for_email_id").val()) + 1;
        $("#signature_first_name").val($("#first_name").val());
        $("#signature_last_name").val($("#last_name").val());
        $("#signature_title").val($("#title").val());
        $("#signature_company").val($("#company").val());
        $("#signature_email").val($("#email").val());
        $("#signature_phone").val($("#phone").val());
        $("#signature_fax").val($("#fax").val());
        $("#signature_website").val($("#website").val());

    }

    $("#custom_branding_test_email_button").click(function(e) {
        e.preventDefault();
        putSignatureinTemplate();
        $("#send-test-email-form").submit();
    });


    $("#template_type_{{!empty($custom_branding_model->template_style)?$custom_branding_model->template_style:0}}").trigger("click");
    $("a[id ^= 'template_type_']").click(function() {
        var data_id = $(this).attr("data-id");

        $("#template_style_for_email_id").val(data_id);
        $("#template_style_id").val(data_id);
        $("div[id ^= 'emailContainer_']").addClass("hide");
        $("div[id ^= 'emailContainer_']").removeClass("show");
        $("#emailContainer_" + data_id).addClass("show");
        putSignatureinTemplate();
    });

    $('#first_name').keyup(delayTyping(function(e) {
        var last_name = $("#last_name").val();
        $("p[id ^= 'signature_firstname_view']").html($(this).val() + " " + last_name);
    }, 500));

    $('#last_name').keyup(delayTyping(function(e) {
        var first_name = $("#first_name").val();
        $("p[id ^= 'signature_firstname_view']").html(first_name + " " + $(this).val());

    }, 500));

    $('#title').keyup(delayTyping(function(e) {

        $("p[id ^= 'signature_title_view']").html($(this).val());

    }, 500));

    $('#company').keyup(delayTyping(function(e) {

        $("p[id ^= 'signature_company_view']").html($(this).val());

    }, 500));
    $('#email').keyup(delayTyping(function(e) {

        $("p[id ^= 'signature_email_view']").html($(this).val());

    }, 500));
    $('#phone').keyup(delayTyping(function(e) {

        $("p[id ^= 'signature_phone_view']").html($(this).val());

    }, 500));
    $('#fax').keyup(delayTyping(function(e) {

        $("p[id ^= 'signature_fax_view']").html($(this).val());

    }, 500));
    $('#website').keyup(delayTyping(function(e) {

        $("p[id ^= 'signature_website_view']").html($(this).val());

    }, 500));
    $("#first_name").trigger("keyup");
    $("#last_name").trigger("keyup");
    $("#title").trigger("keyup");
    $("#company").trigger("keyup");
    $("#email").trigger("keyup");
    $("#phone").trigger("keyup");
    $("#fax").trigger("keyup");
    $("#website").trigger("keyup");
</script>
@append