@extends('layouts.front-user')
@section('title',($title ?? ''))
@section("content")

<!-- Main content -->
<section class="content-header share-allert d-flex justify-content-between">
    <div class="title">
        <h2>{{$title}}</h2>
        <span>Audit Trail is a record of the changes and actions in your PDF Writer account.</span>
    </div>
    <div class="heading-btns">
        <div class="form-group folder-dropdown daterange">
            <label for="folder">Date Range</label>

            {{Form::text('search_text',"",['id'=>'search_text','class' => 'form-control mr-sm-0 daterange2','placeholder' => 'Search'])}}
        </div>

        <!-- <button class="btn btn-warning">Document</button>
                    <button class="btn btn-link">Templates</button>
                    <button class="btn btn-link">Notifications</button> -->
        <div class="position-relative">
            <button class="btn btn-success" id="download_audit_trailid"><i class="fas fa-download"></i> Download Report</button>
        </div>

    </div>
</section>

<section class="content">
    <section class="content" id="list-section">

    </section>

</section>

<input type="hidden" id="page" value="1" />
<input type="hidden" id="max_page" value="10" />

<!-- Your End of page message. Hidden by default -->
<div id="end_of_page" class="center">
    <hr />
    <span>You've reached the end of the audit trail list.</span>
</div>

@endsection

@section('additionaljs')



<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>


<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>

<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<script>
    $(document).ready(function() {

        $('.daterange2').daterangepicker({
            closeText: 'Clear',
            maxDate: "{{date('m/d/Y',time())}}",
        });

        $('.folder-dropdown.daterange').on('cancel.daterangepicker', function(ev, picker) {
            // alert("hello");
            $(".daterange2").val('');
            getAuditTrailList();
        });
        $('#search_text').val("");

        $("#download_audit_trailid").click(function() {
            var search_text = $('#search_text').val();
            search_text = search_text.replace(/\//g, "_");
            //   alert("{{url('/audit-trail/download/')}}/" + search_text);
            window.location.href = "{{url('/audit-trail/download')}}?search_text=" + search_text;
        });

        function getAuditTrailList(page = 1) {
            blockUI();

            var search_text = $('#search_text').val();

            $.ajax({
                url: "{{route('front.audit-trail-data')}}",
                type: "post",
                dataType: 'json',
                data: {
                    "_token": csrf_token,
                    search_text: search_text,
                    "page": page,
                },
                success: function(response) {
                    $('#list-section').html(response.html);

                    $("#max_page").val(parseInt(response.max_page));
                    // $('#items-count').html(response.count + " Items");
                },
                complete: function() {
                    unblockUI();
                },
            });
        }

        $('#search_text').change(function(e) {
            getAuditTrailList();
        });

        getAuditTrailList();


        var outerPane = $('#list-section'),
            didScroll = false;

        $(window).scroll(function() { //watches scroll of the window
            didScroll = true;
        });

        //Sets an interval so your window.scroll event doesn't fire constantly. This waits for the user to stop scrolling for not even a second and then fires the pageCountUpdate function (and then the getPost function)
        setInterval(function() {
            if (didScroll) {
                didScroll = false;
                if (($(document).height() - $(window).height()) - $(window).scrollTop() < 10) {
                    pageCountUpdate();
                }
            }
        }, 250);

        //This function runs when user scrolls. It will call the new posts if the max_page isn't met and will fade in/fade out the end of page message
        function pageCountUpdate() {
            var page = parseInt($('#page').val());
            var max_page = parseInt($('#max_page').val());

            if (page < max_page) {
                $('#page').val(page + 1);
                getPosts();
                $('#end_of_page').hide();
            } else if (page == max_page) {
                getPosts();
                $('#end_of_page').fadeIn();

            } else {
                $('#end_of_page').fadeIn();
            }
        }


        //Ajax call to get your new posts
        function getPosts() {
            getAuditTrailList($('#page').val());
            // alert($('#page').val());
        } //end of getPosts function




    });
</script>

@append