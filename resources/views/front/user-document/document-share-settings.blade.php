@extends('layouts.front-user')
@section("content")

<!-- Content Header (Page header) -->
<section class="content-header share-allert">
    <div class="title">
        <h2>Share</h2>
    </div>
    <div class="share-allert-text">
        <p>Share documents: Add recipients, set permissions and attach a personal message. We’ll send them an invitation to the shared workspace. You’ll be able to see all changes that are made.</p>
    </div>
</section>

<!-- Main content -->
<section class="content">
    {{ Form::open(['url' => '#','method'=>'post','class'=>'login-form','id' => 'user_document_advance_setting_form_id','enctype'=>"multipart/form-data"]) }}
    <div class="advance-settings-part">
        <h3>
            <a class="" data-toggle="collapse" href="#you-are-sharing" aria-expanded="true" aria-controls="you-are-sharing">
                <img class="icon" src="../public/front/images/file-document-outline.svg">
                You Are Sharing <span><img src="../public/front/images/info-i.svg"></span></a>
        </h3>
        <div class="collapse show" id="you-are-sharing">
            <div class="advance-settings-content">
                <div class="row">
                    <div class="col-lg-10 col-md-8">
                        <div class="single-document single-doc-signed">
                            <div class="doc-dots">
                                <button><i class="fas fa-bars"></i></button>
                            </div>
                            <div class="doc-img"><img src="../public/front/images/doc-img-1.png" class="user-image" alt="PDFWriter Admin Image"></div>
                            <div class="doc-content">
                                <h5><a href="<?= $fileUrl ?>" target="_blank"><?= !empty($document_name) ? $document_name : "" ?></a></h5>
                                <!-- <h5>PDFwriter How To Guide</h5>
                                <div class="last-activity">Last update: Nov 12, 2020</div> -->
                            </div>
                            <div class="doc-date-and-dismiss">
                                <a href="" class="edit-fillable-btn"><i class="fas fa-edit"></i> Edit Fillable Fields</a>
                                <button><i class="fas fa-times"></i></button>
                            </div>
                            <div></div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4">
                        <div class="add-single-doc-signed">
                            <a href=""><i class="fas fa-plus-circle"></i> Add Another Document</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h3>
            <a class="" data-toggle="collapse" href="#recipients" aria-expanded="true" aria-controls="recipients">
                <img class="icon" src="../public/front/images/add-user.svg"> Recipients <span><img src="../public/front/images/info-i.svg"></span></a>
        </h3>
        <div class="collapse show" id="recipients">
            <div class="advance-settings-content">
                <div class="share-by">
                    <ul class="nav nav-tabs">
                        <li><a class="active" data-toggle="tab" href="#email-link">Share by Email</a></li>
                        <li><a data-toggle="tab" href="#public-link">Share by Public Link</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="emailnameFromContId" class="alert"></div>
                        <input type="hidden" name="user_email_info_index" id="user_email_info_index" value="0" />
                        <div id="email-link" class="tab-pane fade in active show">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">Email</label>

                                        {{form::text("email","",array("id" => "emailid","class" => "form-control","placeholder" => "Enter Email"))}}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Name</label>

                                        {{form::text("name","",array("id" => "nameid","class" => "form-control","placeholder" => "Enter Name"))}}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <ul>
                                        <li><a class="add-recept-btn" href="#" id="add_recipient_id">Add recipient</a></li>
                                        <li><a class="address-book-btn" href=""><i class="fas fa-address-book"></i> Address Book</a></li>
                                    </ul>
                                    <div id="recipient_container_id"></div>
                                </div>
                            </div>

                        </div>
                        <div id="public-link" class="tab-pane fade">
                            <form>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="public_link">Public Link</label>
                                            <input type="text" class="form-control" id="public_link" value="https://example.com" placeholder="https://example.com">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="recipients-user-info">
                    <div class="user-img"><img src="../public/front/images/user.jpg" class="user-image" alt="PDFWriter Admin Image"></div>
                    <div class="user-content">
                        <h5>PDFwriter How To Guide</h5>
                        <div class="last-activity">johnsmith@gmail.com</div>
                    </div>
                    <div class="user-date-and-dismiss">
                        <div class="user-date">
                            <i class="fas fa-bell"></i>
                            <select class="my-dropdown">
                                <option value="notify">Notify</option>
                                <option value="dont_notify">Don't Notify</option>
                            </select>
                        </div>
                        <div class="bradcrumb">
                            <ul>
                                <li>
                                    <i class="fas fa-home"></i> Home
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>

                <div class="recipients-user-info">
                    <div class="user-img"><img src="../public/front/images/user.jpg" class="user-image" alt="PDFWriter Admin Image"></div>
                    <div class="user-content">
                        <h5>PDFwriter How To Guide</h5>
                        <div class="last-activity">johnsmith@gmail.com</div>
                    </div>
                    <div class="user-date-and-dismiss">
                        <div class="user-date">
                            <i class="fas fa-bell"></i>
                            <select class="my-dropdown">
                                <option value="Notify">Notify</option>
                                <option value="Don't Notify">Don't Notify</option>
                            </select>
                        </div>
                        <div class="user-date">
                            <i class="fas fa-pencil-alt"></i>
                            <select class="my-dropdown">
                                <option value="Can Edit">Can Edit</option>
                                <option value="Don't Edit">Don't Edit</option>
                            </select>
                        </div>

                        <button><i class="fas fa-times"></i></button>
                    </div>
                </div>

            </div>
        </div>
        <h3>
            <a class="" data-toggle="collapse" href="#authenticate-recipient" aria-expanded="true" aria-controls="authenticate-recipient">
                <img class="icon" src="../public/front/images/authenticate-recipient.svg"> Authenticate Recipient <span><img src="../public/front/images/info-i.svg"></span>
            </a>
        </h3>
        <div class="collapse show" id="authenticate-recipient">
            <div class="advance-settings-content">
                <div class="authentication-method">
                    <div class="authentication-method-title">
                        <h6>Authentication Method</h6>
                    </div>
                    <div class="authentication-method-disc">
                        <?php
                        $checkbox_index = 1;
                        foreach ($authentication_method as $authenti_value => $authenticationField) {
                            $social_icons = "";
                            if ($authenti_value == "social_media") {
                                $social_icons = '<span class="fb"><i class="fab fa-facebook-f"></i></span> <span class="google"><img src="../public/front/images/google_g.svg"></span>';
                            }
                        ?>
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="checkbox-<?= $checkbox_index ?>">
                                {{ Form::checkbox('authentication_method',$authenti_value,null, array('id'=>'authentication_methodid')) }}
                                <label class="custom-control-label" for="checkbox-1"><?= $authenticationField ?><?= $social_icons ?></label>
                            </div>
                        <?php
                            $checkbox_index += 1;
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>


        <h3>
            <a class="" data-toggle="collapse" href="#personalize_your_invitation" aria-expanded="true" aria-controls="personalize_your_invitation">
                <img class="icon" src="../public/front/images/authenticate-recipient.svg"> Personalize Your Invitation <span><img src="../public/front/images/info-i.svg"></span>
            </a>
        </h3>
        <div class="collapse show" id="personalize_your_invitation">
            <div class="advance-settings-content">
                <div class="authentication-method">
                    <div class="personalize-invitation-part">
                        <div class="row">
                            <div class="col-md-3 col-lg-2">
                                <div class="personalize-invitation-title">
                                    <h6>Your Logo</h6>
                                </div>
                            </div>
                            <div class="col-md-9 col-lg-10">
                                <div class="personalize-invitation-content">
                                    <p>Replace the default PDF Writer logo with your own (optional).</p>
                                    <ul class="template-types logo-type">
                                        <!--  <li>
                                            <img src="../public/front/images/add-new-logo.png">
                                        </li> -->
                                        <li>
                                            <img src="../public/front/images/logo-blue.png">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 col-lg-2">
                                <div class="personalize-invitation-title">
                                    <h6>Select Template</h6>
                                </div>
                            </div>
                            <div class="col-md-9 col-lg-10">
                                <div class="personalize-invitation-content">
                                    <ul class="template-types">
                                        <?php
                                        foreach ($user_advance_setting_templates as $temp_sett_val => $temp_Caption) {
                                        ?> <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14.21" height="14.21" viewBox="0 0 14.21 14.21">
                                                    <path d="M11.672,34.03H10.15V32.761A.761.761,0,0,0,9.389,32H.761A.761.761,0,0,0,0,32.761V45.449a.761.761,0,0,0,.761.761H9.389a.761.761,0,0,0,.761-.761V44.113l2.557-1.141a2.54,2.54,0,0,0,1.5-2.317V36.567A2.54,2.54,0,0,0,11.672,34.03Zm.507,6.625a.508.508,0,0,1-.3.463l-1.729.772V36.06h1.522a.508.508,0,0,1,.507.507ZM6.6,43.165a.508.508,0,0,1-.507-.508v-7.1a.507.507,0,0,1,1.015,0v7.1A.508.508,0,0,1,6.6,43.165Zm-3.045,0a.508.508,0,0,1-.507-.508v-7.1a.507.507,0,0,1,1.015,0v7.1A.508.508,0,0,1,3.552,43.165Z" transform="translate(0 -32)"></path>
                                                </svg>
                                                {{ Form::radio('select_template', $temp_sett_val , false) }}
                                                <span><?= $temp_Caption ?></span>
                                            </li>
                                        <?php
                                        }
                                        ?>




                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 col-lg-2">
                                <div class="personalize-invitation-title">
                                    <h6>Subject</h6>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-8">
                                <div class="personalize-invitation-content">

                                    {{form::text("template_subject","",array("id" => "template_subjectid","class" => "form-control","placeholder" => "Enter your Subject"))}}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 col-lg-2">
                                <div class="personalize-invitation-title">
                                    <h6>Message</h6>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-8">
                                <div class="personalize-invitation-content">
                                    <!--<textarea rows="5" class="form-control" placeholder="Enter your Message"></textarea>-->
                                    {{form::textarea("template_message","",array("id" => "template_subjectid","class" => "form-control","placeholder" => "Enter your Message"))}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="personalize-invitation-title">
                                    <h6>Your Business Card</h6>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-2">
                                <div class="avatar-upload">
                                    <div class="avatar-preview">
                                        <div id="imagePreview" style="background-image: url(../public/front/images/avatar.svg);">
                                        </div>
                                    </div>
                                    <div class="avatar-edit">
                                        <input type="file" id="imageUpload" accept=".png, .jpg, .jpeg">
                                        <label for="imageUpload">Add Picture</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-8">
                                <div class="personalize-invitation-content">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{form::text("first_name","",array("id" => "first_nameid","class" => "form-control","placeholder" => "First Name"))}}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{form::text("last_name","",array("id" => "last_nameid","class" => "form-control","placeholder" => "Last Name"))}}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{form::text("job_title","",array("id" => "job_titleid","class" => "form-control","placeholder" => "Job Title"))}}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{form::text("Company","",array("id" => "Companyid","class" => "form-control","placeholder" => "Company"))}}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                {{form::text("business_card_email","",array("id" => "business_card_emailid","class" => "form-control","placeholder" => "Email"))}}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{form::text("phone_number","",array("id" => "phone_numberid","class" => "form-control","placeholder" => "Phone Number"))}}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{form::text("fax_number","",array("id" => "fax_numberid","class" => "form-control","placeholder" => "Fax Number"))}}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{form::text("Website","",array("id" => "Websiteid","class" => "form-control","placeholder" => "Website"))}}

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <h3>
            <a class="" data-toggle="collapse" href="#reminders-for-recipients" aria-expanded="true" aria-controls="reminders-for-recipients">
                <img class="icon" src="../public/front/images/bell.svg"> Authenticate Recipient <span><img src="../public/front/images/info-i.svg"></span>
            </a>
        </h3>
        <div class="collapse show" id="reminders-for-recipients">
            <div class="advance-settings-content">
                <div class="authentication-method pb-0">
                    <div class="personalize-invitation-part">
                        <div class="row">
                            <div class="col-md-3 col-lg-2">
                                <div class="personalize-invitation-title">
                                    <h6>Automatic Reminder</h6>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-8">
                                <div class="personalize-invitation-content">

                                    {!! Form::select('user_advance_automatic_reminder', $user_advance_settings_automatic_reminder, array('id' => 'user_advance_automatic_reminderid','class' => 'my-dropdown')) !!}
                                    <span class="reminder-text">If your shared documents haven't been opened by 12/12/2020.</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-lg-2">
                                <div class="personalize-invitation-title">
                                    <h6>Repeat the Reminder</h6>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-8">
                                <div class="personalize-invitation-content">
                                    {!! Form::select('user_advance_settings_repeat_reminder', $user_advance_settings_repeat_reminder, array('id' => 'user_advance_settings_repeat_reminderid','class' => 'my-dropdown')) !!}

                                    <span class="reminder-text">If the documents haven't been opened by 12/13/2020.</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="advance-settings-btns">

            {{Form::submit('Submit',array('class' => 'share-btn'))}}
            <a href="#" class="my-doc-btn">My Docs</a>
        </div>

    </div>
    {{ Form::close() }}

</section>
<!-- /.content -->

@endsection