@extends('layouts.pdf-search')
@section('title',($title ?? ''))
@section("content")
<!-- Content Header (Page header) -->


<section class="search-banner" style="background: url({{asset('public/front/images/search-bg.png')}})">
    <!-- <div class="banner-img">
            <img src="../public/front/images/pricing-banner-bg.svg">
        </div> -->
    <div class="banner-content">
        <div class="container">
            <div class="search-part">
                <div class="search-content">
                    <h3>Welcome to the <span class="green-color">fillable PDF form libraryHeading</span></h3>
                    <p>Choose from 25 million fillable PDF forms in the PDF writer online library. Fill out a fillable form, customize it to your needs, and send it to your customers and clients.</p>

                    <!-- <form class="search-form">-->
                    {{ Form::open(['url' => '#','method'=>'post','class'=>'search-form']) }}
                    <div class="search-input">
                        <!-- <input type="text" placeholder="Search here...">-->
                        {{ Form::text('pdf_search',null,array('id' => 'pdf_search','class' => 'form-control','placeholder' => 'PDF-Search')) }}
                        <img src="{{asset('public/front/images/search-icon.svg')}}">
                    </div>
                    <div class="search-btn">
                        <button id="google_pdf_search_btn_id">Search</button>
                    </div>
                    {{ Form::close() }}
                </div>
                <div class="search-image">
                    <img src="{{asset('public/front/images/search-banner-img.svg')}}">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="search-results mb-0">
    <div class="container">

    </div>
</section>

<section class="fillable-pdf-forms">
    <div class="container">
        <div class="row no-gutters  d-md-flex align-items-center">
            <div class="col-md-3">
                <div class="fillable-pdf-forms-img">
                    <img src="{{asset('public/front/images/fillable-pdf-forms-img.png')}}">
                </div>
            </div>
            <div class="col-md-9">
                <div class="fillable-pdf-forms-content">
                    <h2><span class="green-color">Top 100</span> fillable PDF forms</h2>
                    <p>Save time looking for the PDF form you need. Get quick access to the most popular forms on any desktop or mobile device. </p>
                    <a href="#">Browse top 100</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="drives-section find-fillable-forms" style="background: url({{asset('public/front/images/find-fillable-forms-bg.png')}});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>How to Find the PDF Fillable Forms with PDF writer</h2>
            </div>
            <div class="col-md-4 mb-30">
                <div class="card h-100">
                    <h4>Describe the form you’re searching for in the box above</h4>
                    <ul class="about-fillable-form-list">
                        <li>Find government employee benefits forms or federal benefits application forms.</li>
                        <li>Data encryption in transit and at rest & routed through third-party servers.</li>
                        <li>Search for child benefits applications or parent dependent benefits applications.</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 mb-30">
                <div class="card position-relative h-100">
                    <h4>Once you’ve found the form, click the orange «Fill Online» button</h4>
                    <ul class="about-fillable-form-list">
                        <li>PDF writer allows you to type on any form you find.</li>
                        <li>You can also sign any form with a signature font or a real signature. </li>
                        <li>You can rearrange the document, choose pages you want & delete the ones you don’t.</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 mb-30">
                <div class="card position-relative h-100">
                    <h4>When done, you can download, email, print or fax the filled out form</h4>
                    <p>If you like our service, don’t forget to share with your friends:</p>
                    <ul class="social-icons">
                        <li>
                            <a class="facebook" href="#">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a class="linkedin" href="#">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </li>
                        <li>
                            <a class="twitter" href="#">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a class="pinterest" href="#">
                                <i class="fab fa-pinterest-p"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="solve-pdf-problems text-center">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Solve all your <span class="green-color">PDF problems</span></h2>
            </div>

            <div class="col-12">
                <ul class="nav nav-tabs nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#cc" role="tab" aria-controls="cc" aria-selected="true">
                            <span>Convert & Compress</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#sm" role="tab" aria-controls="sm" aria-selected="false">
                            <span>Split & Merge</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#cf-pdf" role="tab" aria-controls="cf-pdf" aria-selected="false">
                            <span>Convert from PDF</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#ve" role="tab" aria-controls="ve" aria-selected="false">
                            <span>View & Edit</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#ctopdf" role="tab" aria-controls="ctopdf" aria-selected="false">
                            <span>Convert to PDF</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#ss" role="tab" aria-controls="ss" aria-selected="false">
                            <span>Sign and Security</span>
                        </a>
                    </li>
                </ul>

                <div class="pdf-issues tab-content mt-3">
                    <div class="tab-pane active" id="cc" role="tabpanel" aria-labelledby="duck-tab">
                        <ul class="d-flex justify-content-around">
                            <li>
                                <a href="">

                                    <div class="doc-icon">
                                        <img src="{{asset('public/front/images/pencil.svg')}}">
                                    </div><span>Edit PDF</span>
                                </a>
                            </li>
                            <li>
                                <a href="">

                                    <div class="doc-icon">
                                        <img src="{{asset('public/front/images/trash.svg')}}">
                                    </div><span>Delete Page</span>
                                </a>
                            </li>
                            <li>
                                <a href="">

                                    <div class="doc-icon">
                                        <img src="{{asset('public/front/images/rotate-left-variant.svg')}}">
                                    </div><span>Rotate PDF</span>
                                </a>
                            </li>
                            <li>
                                <a href="">

                                    <div class="doc-icon">
                                        <img src="{{asset('public/front/images/pdf-reader.svg')}}">
                                    </div><span>PDF Reader</span>
                                </a>
                            </li>
                            <li>
                                <a href="">

                                    <div class="doc-icon">
                                        <img src="{{asset('public/front/images/edit-split.svg')}}">
                                    </div><span>Edit & Split</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <div class="doc-icon">
                                        <img src="{{asset('public/front/images/page-numbring.svg')}}">
                                    </div>
                                    <span>Page Numbering</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <div class="doc-icon">
                                        <img src="{{asset('public/front/images/watermark.svg')}}">
                                    </div>
                                    <span>Watermark</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane" id="sm" role="tabpanel" aria-labelledby="chicken-tab">
                        <ul class="d-flex justify-content-around">
                            <li>
                                <a href="">

                                    <div class="doc-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32.62" height="31.352" viewBox="0 0 32.62 31.352">
                                            <defs></defs>
                                            <path class="a" d="M3,20.454,12.6,26.8l6.705-5.618-9.6-5.98ZM12.6,3.6,3,9.943,9.705,15.2l9.6-5.98ZM35.62,9.943,26.016,3.6,19.31,9.218l9.6,5.98ZM19.31,21.179,26.016,26.8l9.6-6.343L28.915,15.2Zm0,2.175L12.6,28.971l-2.9-1.993v2.175l9.6,5.8,9.6-5.8V26.978l-2.9,1.993Z" transform="translate(-3 -3.6)" />
                                        </svg>
                                    </div><span>Edit PDF</span>
                                </a>
                            </li>
                            <li>
                                <a href="">

                                    <div class="doc-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32.62" height="31.352" viewBox="0 0 32.62 31.352">
                                            <defs></defs>
                                            <path class="a" d="M3,20.454,12.6,26.8l6.705-5.618-9.6-5.98ZM12.6,3.6,3,9.943,9.705,15.2l9.6-5.98ZM35.62,9.943,26.016,3.6,19.31,9.218l9.6,5.98ZM19.31,21.179,26.016,26.8l9.6-6.343L28.915,15.2Zm0,2.175L12.6,28.971l-2.9-1.993v2.175l9.6,5.8,9.6-5.8V26.978l-2.9,1.993Z" transform="translate(-3 -3.6)" />
                                        </svg>
                                    </div><span>Delete Page</span>
                                </a>
                            </li>
                            <li>
                                <a href="">

                                    <div class="doc-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32.62" height="31.352" viewBox="0 0 32.62 31.352">
                                            <defs></defs>
                                            <path class="a" d="M3,20.454,12.6,26.8l6.705-5.618-9.6-5.98ZM12.6,3.6,3,9.943,9.705,15.2l9.6-5.98ZM35.62,9.943,26.016,3.6,19.31,9.218l9.6,5.98ZM19.31,21.179,26.016,26.8l9.6-6.343L28.915,15.2Zm0,2.175L12.6,28.971l-2.9-1.993v2.175l9.6,5.8,9.6-5.8V26.978l-2.9,1.993Z" transform="translate(-3 -3.6)" />
                                        </svg>
                                    </div><span>Rotate PDF</span>
                                </a>
                            </li>
                            <li>
                                <a href="">

                                    <div class="doc-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32.62" height="31.352" viewBox="0 0 32.62 31.352">
                                            <defs></defs>
                                            <path class="a" d="M3,20.454,12.6,26.8l6.705-5.618-9.6-5.98ZM12.6,3.6,3,9.943,9.705,15.2l9.6-5.98ZM35.62,9.943,26.016,3.6,19.31,9.218l9.6,5.98ZM19.31,21.179,26.016,26.8l9.6-6.343L28.915,15.2Zm0,2.175L12.6,28.971l-2.9-1.993v2.175l9.6,5.8,9.6-5.8V26.978l-2.9,1.993Z" transform="translate(-3 -3.6)" />
                                        </svg>
                                    </div><span>PDF Reader</span>
                                </a>
                            </li>
                            <li>
                                <a href="">

                                    <div class="doc-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32.62" height="31.352" viewBox="0 0 32.62 31.352">
                                            <defs></defs>
                                            <path class="a" d="M3,20.454,12.6,26.8l6.705-5.618-9.6-5.98ZM12.6,3.6,3,9.943,9.705,15.2l9.6-5.98ZM35.62,9.943,26.016,3.6,19.31,9.218l9.6,5.98ZM19.31,21.179,26.016,26.8l9.6-6.343L28.915,15.2Zm0,2.175L12.6,28.971l-2.9-1.993v2.175l9.6,5.8,9.6-5.8V26.978l-2.9,1.993Z" transform="translate(-3 -3.6)" />
                                        </svg>
                                    </div><span>Edit & Split</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <div class="doc-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32.62" height="31.352" viewBox="0 0 32.62 31.352">
                                            <defs></defs>
                                            <path class="a" d="M3,20.454,12.6,26.8l6.705-5.618-9.6-5.98ZM12.6,3.6,3,9.943,9.705,15.2l9.6-5.98ZM35.62,9.943,26.016,3.6,19.31,9.218l9.6,5.98ZM19.31,21.179,26.016,26.8l9.6-6.343L28.915,15.2Zm0,2.175L12.6,28.971l-2.9-1.993v2.175l9.6,5.8,9.6-5.8V26.978l-2.9,1.993Z" transform="translate(-3 -3.6)" />
                                        </svg>
                                    </div>
                                    <span>Page Numbering</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <div class="doc-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32.62" height="31.352" viewBox="0 0 32.62 31.352">
                                            <defs></defs>
                                            <path class="a" d="M3,20.454,12.6,26.8l6.705-5.618-9.6-5.98ZM12.6,3.6,3,9.943,9.705,15.2l9.6-5.98ZM35.62,9.943,26.016,3.6,19.31,9.218l9.6,5.98ZM19.31,21.179,26.016,26.8l9.6-6.343L28.915,15.2Zm0,2.175L12.6,28.971l-2.9-1.993v2.175l9.6,5.8,9.6-5.8V26.978l-2.9,1.993Z" transform="translate(-3 -3.6)" />
                                        </svg>
                                    </div>
                                    <span>Watermark</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane" id="cf-pdf" role="tabpanel" aria-labelledby="kiwi-tab">
                        <ul class="d-flex justify-content-around">
                            <li>
                                <a href="">

                                    <div class="doc-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32.62" height="31.352" viewBox="0 0 32.62 31.352">
                                            <defs></defs>
                                            <path class="a" d="M3,20.454,12.6,26.8l6.705-5.618-9.6-5.98ZM12.6,3.6,3,9.943,9.705,15.2l9.6-5.98ZM35.62,9.943,26.016,3.6,19.31,9.218l9.6,5.98ZM19.31,21.179,26.016,26.8l9.6-6.343L28.915,15.2Zm0,2.175L12.6,28.971l-2.9-1.993v2.175l9.6,5.8,9.6-5.8V26.978l-2.9,1.993Z" transform="translate(-3 -3.6)" />
                                        </svg>
                                    </div><span>Edit PDF</span>
                                </a>
                            </li>
                            <li>
                                <a href="">

                                    <div class="doc-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32.62" height="31.352" viewBox="0 0 32.62 31.352">
                                            <defs></defs>
                                            <path class="a" d="M3,20.454,12.6,26.8l6.705-5.618-9.6-5.98ZM12.6,3.6,3,9.943,9.705,15.2l9.6-5.98ZM35.62,9.943,26.016,3.6,19.31,9.218l9.6,5.98ZM19.31,21.179,26.016,26.8l9.6-6.343L28.915,15.2Zm0,2.175L12.6,28.971l-2.9-1.993v2.175l9.6,5.8,9.6-5.8V26.978l-2.9,1.993Z" transform="translate(-3 -3.6)" />
                                        </svg>
                                    </div><span>Delete Page</span>
                                </a>
                            </li>
                            <li>
                                <a href="">

                                    <div class="doc-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32.62" height="31.352" viewBox="0 0 32.62 31.352">
                                            <defs></defs>
                                            <path class="a" d="M3,20.454,12.6,26.8l6.705-5.618-9.6-5.98ZM12.6,3.6,3,9.943,9.705,15.2l9.6-5.98ZM35.62,9.943,26.016,3.6,19.31,9.218l9.6,5.98ZM19.31,21.179,26.016,26.8l9.6-6.343L28.915,15.2Zm0,2.175L12.6,28.971l-2.9-1.993v2.175l9.6,5.8,9.6-5.8V26.978l-2.9,1.993Z" transform="translate(-3 -3.6)" />
                                        </svg>
                                    </div><span>Rotate PDF</span>
                                </a>
                            </li>
                            <li>
                                <a href="">

                                    <div class="doc-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32.62" height="31.352" viewBox="0 0 32.62 31.352">
                                            <defs></defs>
                                            <path class="a" d="M3,20.454,12.6,26.8l6.705-5.618-9.6-5.98ZM12.6,3.6,3,9.943,9.705,15.2l9.6-5.98ZM35.62,9.943,26.016,3.6,19.31,9.218l9.6,5.98ZM19.31,21.179,26.016,26.8l9.6-6.343L28.915,15.2Zm0,2.175L12.6,28.971l-2.9-1.993v2.175l9.6,5.8,9.6-5.8V26.978l-2.9,1.993Z" transform="translate(-3 -3.6)" />
                                        </svg>
                                    </div><span>PDF Reader</span>
                                </a>
                            </li>
                            <li>
                                <a href="">

                                    <div class="doc-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32.62" height="31.352" viewBox="0 0 32.62 31.352">
                                            <defs></defs>
                                            <path class="a" d="M3,20.454,12.6,26.8l6.705-5.618-9.6-5.98ZM12.6,3.6,3,9.943,9.705,15.2l9.6-5.98ZM35.62,9.943,26.016,3.6,19.31,9.218l9.6,5.98ZM19.31,21.179,26.016,26.8l9.6-6.343L28.915,15.2Zm0,2.175L12.6,28.971l-2.9-1.993v2.175l9.6,5.8,9.6-5.8V26.978l-2.9,1.993Z" transform="translate(-3 -3.6)" />
                                        </svg>
                                    </div><span>Edit & Split</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <div class="doc-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32.62" height="31.352" viewBox="0 0 32.62 31.352">
                                            <defs></defs>
                                            <path class="a" d="M3,20.454,12.6,26.8l6.705-5.618-9.6-5.98ZM12.6,3.6,3,9.943,9.705,15.2l9.6-5.98ZM35.62,9.943,26.016,3.6,19.31,9.218l9.6,5.98ZM19.31,21.179,26.016,26.8l9.6-6.343L28.915,15.2Zm0,2.175L12.6,28.971l-2.9-1.993v2.175l9.6,5.8,9.6-5.8V26.978l-2.9,1.993Z" transform="translate(-3 -3.6)" />
                                        </svg>
                                    </div>
                                    <span>Page Numbering</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <div class="doc-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32.62" height="31.352" viewBox="0 0 32.62 31.352">
                                            <defs></defs>
                                            <path class="a" d="M3,20.454,12.6,26.8l6.705-5.618-9.6-5.98ZM12.6,3.6,3,9.943,9.705,15.2l9.6-5.98ZM35.62,9.943,26.016,3.6,19.31,9.218l9.6,5.98ZM19.31,21.179,26.016,26.8l9.6-6.343L28.915,15.2Zm0,2.175L12.6,28.971l-2.9-1.993v2.175l9.6,5.8,9.6-5.8V26.978l-2.9,1.993Z" transform="translate(-3 -3.6)" />
                                        </svg>
                                    </div>
                                    <span>Watermark</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane" id="ve" role="tabpanel" aria-labelledby="emu-tab">
                        <ul class="d-flex justify-content-around">
                            <li>
                                <a href="">

                                    <div class="doc-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32.62" height="31.352" viewBox="0 0 32.62 31.352">
                                            <defs></defs>
                                            <path class="a" d="M3,20.454,12.6,26.8l6.705-5.618-9.6-5.98ZM12.6,3.6,3,9.943,9.705,15.2l9.6-5.98ZM35.62,9.943,26.016,3.6,19.31,9.218l9.6,5.98ZM19.31,21.179,26.016,26.8l9.6-6.343L28.915,15.2Zm0,2.175L12.6,28.971l-2.9-1.993v2.175l9.6,5.8,9.6-5.8V26.978l-2.9,1.993Z" transform="translate(-3 -3.6)" />
                                        </svg>
                                    </div><span>Edit PDF</span>
                                </a>
                            </li>
                            <li>
                                <a href="">

                                    <div class="doc-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32.62" height="31.352" viewBox="0 0 32.62 31.352">
                                            <defs></defs>
                                            <path class="a" d="M3,20.454,12.6,26.8l6.705-5.618-9.6-5.98ZM12.6,3.6,3,9.943,9.705,15.2l9.6-5.98ZM35.62,9.943,26.016,3.6,19.31,9.218l9.6,5.98ZM19.31,21.179,26.016,26.8l9.6-6.343L28.915,15.2Zm0,2.175L12.6,28.971l-2.9-1.993v2.175l9.6,5.8,9.6-5.8V26.978l-2.9,1.993Z" transform="translate(-3 -3.6)" />
                                        </svg>
                                    </div><span>Delete Page</span>
                                </a>
                            </li>
                            <li>
                                <a href="">

                                    <div class="doc-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32.62" height="31.352" viewBox="0 0 32.62 31.352">
                                            <defs></defs>
                                            <path class="a" d="M3,20.454,12.6,26.8l6.705-5.618-9.6-5.98ZM12.6,3.6,3,9.943,9.705,15.2l9.6-5.98ZM35.62,9.943,26.016,3.6,19.31,9.218l9.6,5.98ZM19.31,21.179,26.016,26.8l9.6-6.343L28.915,15.2Zm0,2.175L12.6,28.971l-2.9-1.993v2.175l9.6,5.8,9.6-5.8V26.978l-2.9,1.993Z" transform="translate(-3 -3.6)" />
                                        </svg>
                                    </div><span>Rotate PDF</span>
                                </a>
                            </li>
                            <li>
                                <a href="">

                                    <div class="doc-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32.62" height="31.352" viewBox="0 0 32.62 31.352">
                                            <defs></defs>
                                            <path class="a" d="M3,20.454,12.6,26.8l6.705-5.618-9.6-5.98ZM12.6,3.6,3,9.943,9.705,15.2l9.6-5.98ZM35.62,9.943,26.016,3.6,19.31,9.218l9.6,5.98ZM19.31,21.179,26.016,26.8l9.6-6.343L28.915,15.2Zm0,2.175L12.6,28.971l-2.9-1.993v2.175l9.6,5.8,9.6-5.8V26.978l-2.9,1.993Z" transform="translate(-3 -3.6)" />
                                        </svg>
                                    </div><span>PDF Reader</span>
                                </a>
                            </li>
                            <li>
                                <a href="">

                                    <div class="doc-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32.62" height="31.352" viewBox="0 0 32.62 31.352">
                                            <defs></defs>
                                            <path class="a" d="M3,20.454,12.6,26.8l6.705-5.618-9.6-5.98ZM12.6,3.6,3,9.943,9.705,15.2l9.6-5.98ZM35.62,9.943,26.016,3.6,19.31,9.218l9.6,5.98ZM19.31,21.179,26.016,26.8l9.6-6.343L28.915,15.2Zm0,2.175L12.6,28.971l-2.9-1.993v2.175l9.6,5.8,9.6-5.8V26.978l-2.9,1.993Z" transform="translate(-3 -3.6)" />
                                        </svg>
                                    </div><span>Edit & Split</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <div class="doc-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32.62" height="31.352" viewBox="0 0 32.62 31.352">
                                            <defs></defs>
                                            <path class="a" d="M3,20.454,12.6,26.8l6.705-5.618-9.6-5.98ZM12.6,3.6,3,9.943,9.705,15.2l9.6-5.98ZM35.62,9.943,26.016,3.6,19.31,9.218l9.6,5.98ZM19.31,21.179,26.016,26.8l9.6-6.343L28.915,15.2Zm0,2.175L12.6,28.971l-2.9-1.993v2.175l9.6,5.8,9.6-5.8V26.978l-2.9,1.993Z" transform="translate(-3 -3.6)" />
                                        </svg>
                                    </div>
                                    <span>Page Numbering</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <div class="doc-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32.62" height="31.352" viewBox="0 0 32.62 31.352">
                                            <defs></defs>
                                            <path class="a" d="M3,20.454,12.6,26.8l6.705-5.618-9.6-5.98ZM12.6,3.6,3,9.943,9.705,15.2l9.6-5.98ZM35.62,9.943,26.016,3.6,19.31,9.218l9.6,5.98ZM19.31,21.179,26.016,26.8l9.6-6.343L28.915,15.2Zm0,2.175L12.6,28.971l-2.9-1.993v2.175l9.6,5.8,9.6-5.8V26.978l-2.9,1.993Z" transform="translate(-3 -3.6)" />
                                        </svg>
                                    </div>
                                    <span>Watermark</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane" id="ctopdf" role="tabpanel" aria-labelledby="emu-tab">
                        <ul class="d-flex justify-content-around">
                            <li>
                                <a href="">

                                    <div class="doc-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32.62" height="31.352" viewBox="0 0 32.62 31.352">
                                            <defs></defs>
                                            <path class="a" d="M3,20.454,12.6,26.8l6.705-5.618-9.6-5.98ZM12.6,3.6,3,9.943,9.705,15.2l9.6-5.98ZM35.62,9.943,26.016,3.6,19.31,9.218l9.6,5.98ZM19.31,21.179,26.016,26.8l9.6-6.343L28.915,15.2Zm0,2.175L12.6,28.971l-2.9-1.993v2.175l9.6,5.8,9.6-5.8V26.978l-2.9,1.993Z" transform="translate(-3 -3.6)" />
                                        </svg>
                                    </div><span>Edit PDF</span>
                                </a>
                            </li>
                            <li>
                                <a href="">

                                    <div class="doc-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32.62" height="31.352" viewBox="0 0 32.62 31.352">
                                            <defs></defs>
                                            <path class="a" d="M3,20.454,12.6,26.8l6.705-5.618-9.6-5.98ZM12.6,3.6,3,9.943,9.705,15.2l9.6-5.98ZM35.62,9.943,26.016,3.6,19.31,9.218l9.6,5.98ZM19.31,21.179,26.016,26.8l9.6-6.343L28.915,15.2Zm0,2.175L12.6,28.971l-2.9-1.993v2.175l9.6,5.8,9.6-5.8V26.978l-2.9,1.993Z" transform="translate(-3 -3.6)" />
                                        </svg>
                                    </div><span>Delete Page</span>
                                </a>
                            </li>
                            <li>
                                <a href="">

                                    <div class="doc-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32.62" height="31.352" viewBox="0 0 32.62 31.352">
                                            <defs></defs>
                                            <path class="a" d="M3,20.454,12.6,26.8l6.705-5.618-9.6-5.98ZM12.6,3.6,3,9.943,9.705,15.2l9.6-5.98ZM35.62,9.943,26.016,3.6,19.31,9.218l9.6,5.98ZM19.31,21.179,26.016,26.8l9.6-6.343L28.915,15.2Zm0,2.175L12.6,28.971l-2.9-1.993v2.175l9.6,5.8,9.6-5.8V26.978l-2.9,1.993Z" transform="translate(-3 -3.6)" />
                                        </svg>
                                    </div><span>Rotate PDF</span>
                                </a>
                            </li>
                            <li>
                                <a href="">

                                    <div class="doc-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32.62" height="31.352" viewBox="0 0 32.62 31.352">
                                            <defs></defs>
                                            <path class="a" d="M3,20.454,12.6,26.8l6.705-5.618-9.6-5.98ZM12.6,3.6,3,9.943,9.705,15.2l9.6-5.98ZM35.62,9.943,26.016,3.6,19.31,9.218l9.6,5.98ZM19.31,21.179,26.016,26.8l9.6-6.343L28.915,15.2Zm0,2.175L12.6,28.971l-2.9-1.993v2.175l9.6,5.8,9.6-5.8V26.978l-2.9,1.993Z" transform="translate(-3 -3.6)" />
                                        </svg>
                                    </div><span>PDF Reader</span>
                                </a>
                            </li>
                            <li>
                                <a href="">

                                    <div class="doc-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32.62" height="31.352" viewBox="0 0 32.62 31.352">
                                            <defs></defs>
                                            <path class="a" d="M3,20.454,12.6,26.8l6.705-5.618-9.6-5.98ZM12.6,3.6,3,9.943,9.705,15.2l9.6-5.98ZM35.62,9.943,26.016,3.6,19.31,9.218l9.6,5.98ZM19.31,21.179,26.016,26.8l9.6-6.343L28.915,15.2Zm0,2.175L12.6,28.971l-2.9-1.993v2.175l9.6,5.8,9.6-5.8V26.978l-2.9,1.993Z" transform="translate(-3 -3.6)" />
                                        </svg>
                                    </div><span>Edit & Split</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <div class="doc-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32.62" height="31.352" viewBox="0 0 32.62 31.352">
                                            <defs></defs>
                                            <path class="a" d="M3,20.454,12.6,26.8l6.705-5.618-9.6-5.98ZM12.6,3.6,3,9.943,9.705,15.2l9.6-5.98ZM35.62,9.943,26.016,3.6,19.31,9.218l9.6,5.98ZM19.31,21.179,26.016,26.8l9.6-6.343L28.915,15.2Zm0,2.175L12.6,28.971l-2.9-1.993v2.175l9.6,5.8,9.6-5.8V26.978l-2.9,1.993Z" transform="translate(-3 -3.6)" />
                                        </svg>
                                    </div>
                                    <span>Page Numbering</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <div class="doc-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32.62" height="31.352" viewBox="0 0 32.62 31.352">
                                            <defs></defs>
                                            <path class="a" d="M3,20.454,12.6,26.8l6.705-5.618-9.6-5.98ZM12.6,3.6,3,9.943,9.705,15.2l9.6-5.98ZM35.62,9.943,26.016,3.6,19.31,9.218l9.6,5.98ZM19.31,21.179,26.016,26.8l9.6-6.343L28.915,15.2Zm0,2.175L12.6,28.971l-2.9-1.993v2.175l9.6,5.8,9.6-5.8V26.978l-2.9,1.993Z" transform="translate(-3 -3.6)" />
                                        </svg>
                                    </div>
                                    <span>Watermark</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane" id="ss" role="tabpanel" aria-labelledby="emu-tab">
                        <ul class="d-flex justify-content-around">
                            <li>
                                <a href="">

                                    <div class="doc-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32.62" height="31.352" viewBox="0 0 32.62 31.352">
                                            <defs></defs>
                                            <path class="a" d="M3,20.454,12.6,26.8l6.705-5.618-9.6-5.98ZM12.6,3.6,3,9.943,9.705,15.2l9.6-5.98ZM35.62,9.943,26.016,3.6,19.31,9.218l9.6,5.98ZM19.31,21.179,26.016,26.8l9.6-6.343L28.915,15.2Zm0,2.175L12.6,28.971l-2.9-1.993v2.175l9.6,5.8,9.6-5.8V26.978l-2.9,1.993Z" transform="translate(-3 -3.6)" />
                                        </svg>
                                    </div><span>Edit PDF</span>
                                </a>
                            </li>
                            <li>
                                <a href="">

                                    <div class="doc-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32.62" height="31.352" viewBox="0 0 32.62 31.352">
                                            <defs></defs>
                                            <path class="a" d="M3,20.454,12.6,26.8l6.705-5.618-9.6-5.98ZM12.6,3.6,3,9.943,9.705,15.2l9.6-5.98ZM35.62,9.943,26.016,3.6,19.31,9.218l9.6,5.98ZM19.31,21.179,26.016,26.8l9.6-6.343L28.915,15.2Zm0,2.175L12.6,28.971l-2.9-1.993v2.175l9.6,5.8,9.6-5.8V26.978l-2.9,1.993Z" transform="translate(-3 -3.6)" />
                                        </svg>
                                    </div><span>Delete Page</span>
                                </a>
                            </li>
                            <li>
                                <a href="">

                                    <div class="doc-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32.62" height="31.352" viewBox="0 0 32.62 31.352">
                                            <defs></defs>
                                            <path class="a" d="M3,20.454,12.6,26.8l6.705-5.618-9.6-5.98ZM12.6,3.6,3,9.943,9.705,15.2l9.6-5.98ZM35.62,9.943,26.016,3.6,19.31,9.218l9.6,5.98ZM19.31,21.179,26.016,26.8l9.6-6.343L28.915,15.2Zm0,2.175L12.6,28.971l-2.9-1.993v2.175l9.6,5.8,9.6-5.8V26.978l-2.9,1.993Z" transform="translate(-3 -3.6)" />
                                        </svg>
                                    </div><span>Rotate PDF</span>
                                </a>
                            </li>
                            <li>
                                <a href="">

                                    <div class="doc-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32.62" height="31.352" viewBox="0 0 32.62 31.352">
                                            <defs></defs>
                                            <path class="a" d="M3,20.454,12.6,26.8l6.705-5.618-9.6-5.98ZM12.6,3.6,3,9.943,9.705,15.2l9.6-5.98ZM35.62,9.943,26.016,3.6,19.31,9.218l9.6,5.98ZM19.31,21.179,26.016,26.8l9.6-6.343L28.915,15.2Zm0,2.175L12.6,28.971l-2.9-1.993v2.175l9.6,5.8,9.6-5.8V26.978l-2.9,1.993Z" transform="translate(-3 -3.6)" />
                                        </svg>
                                    </div><span>PDF Reader</span>
                                </a>
                            </li>
                            <li>
                                <a href="">

                                    <div class="doc-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32.62" height="31.352" viewBox="0 0 32.62 31.352">
                                            <defs></defs>
                                            <path class="a" d="M3,20.454,12.6,26.8l6.705-5.618-9.6-5.98ZM12.6,3.6,3,9.943,9.705,15.2l9.6-5.98ZM35.62,9.943,26.016,3.6,19.31,9.218l9.6,5.98ZM19.31,21.179,26.016,26.8l9.6-6.343L28.915,15.2Zm0,2.175L12.6,28.971l-2.9-1.993v2.175l9.6,5.8,9.6-5.8V26.978l-2.9,1.993Z" transform="translate(-3 -3.6)" />
                                        </svg>
                                    </div><span>Edit & Split</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <div class="doc-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32.62" height="31.352" viewBox="0 0 32.62 31.352">
                                            <defs></defs>
                                            <path class="a" d="M3,20.454,12.6,26.8l6.705-5.618-9.6-5.98ZM12.6,3.6,3,9.943,9.705,15.2l9.6-5.98ZM35.62,9.943,26.016,3.6,19.31,9.218l9.6,5.98ZM19.31,21.179,26.016,26.8l9.6-6.343L28.915,15.2Zm0,2.175L12.6,28.971l-2.9-1.993v2.175l9.6,5.8,9.6-5.8V26.978l-2.9,1.993Z" transform="translate(-3 -3.6)" />
                                        </svg>
                                    </div>
                                    <span>Page Numbering</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <div class="doc-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32.62" height="31.352" viewBox="0 0 32.62 31.352">
                                            <defs></defs>
                                            <path class="a" d="M3,20.454,12.6,26.8l6.705-5.618-9.6-5.98ZM12.6,3.6,3,9.943,9.705,15.2l9.6-5.98ZM35.62,9.943,26.016,3.6,19.31,9.218l9.6,5.98ZM19.31,21.179,26.016,26.8l9.6-6.343L28.915,15.2Zm0,2.175L12.6,28.971l-2.9-1.993v2.175l9.6,5.8,9.6-5.8V26.978l-2.9,1.993Z" transform="translate(-3 -3.6)" />
                                        </svg>
                                    </div>
                                    <span>Watermark</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
@section('additionaljs')
<script>
    $(document).ready(function() {
        $("body").on("click", "#google_pdf_search_btn_id", function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('front.google-pdf-search-apply')}}",
                data: "_token={{csrf_token()}}&pdf_search=" + $("#pdf_search").val(),
                type: "post",
                dataType: 'json',
                success: function(response) {

                    console.log(response);
                    $(".search-results .container").html(response.message);
                    $([document.documentElement, document.body]).animate({
                        scrollTop: $(".search-results").offset().top
                    }, 2000);
                },
                error: function(xhr, errorType, exception) {

                    var jsonData = $.parseJSON(xhr.responseText);
                    console.log(jsonData);

                    // $(".modal_middle_container").html(jsonData.message);
                    toastr.error(jsonData.message);
                }
            });

        });
        $("body").on("click", "a[id ^= 'pdf_page_']", function(e) {

            e.preventDefault();
            var page_index = $(this).attr("data-id");

            $.ajax({
                url: "{{route('front.google-pdf-search-apply')}}",
                data: "_token={{csrf_token()}}&pdf_search=" + $("#pdf_search").val() + "&page=" + page_index,
                type: "post",
                dataType: 'json',
                success: function(response) {

                    $(".search-results .container").html(response.message);
                },
                error: function(xhr, errorType, exception) {

                    var jsonData = $.parseJSON(xhr.responseText);

                    toastr.error(jsonData.message);
                }
            });


        });

    });
</script>
@append