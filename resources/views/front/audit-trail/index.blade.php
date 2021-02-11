@extends('layouts.front-user')
@section('title',($title ?? ''))
@section("content")

<!-- Main content -->
<section class="content-header share-allert d-flex justify-content-between">
    <div class="title">
        <h2>{{$title}}</h2>
        <span>Audit Trail is a record of the changes and actions in your PDF writer account.</span>
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

@endsection

@section('additionaljs')



<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>


<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>

<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<script>
    $(document).ready(function() {

        $('.daterange2').daterangepicker({
            closeText: 'Clear',
        });

        $('.folder-dropdown.daterange').on('cancel.daterangepicker', function(ev, picker) {
            // alert("hello");
            $(".daterange2").val('');
            getAuditTrailList();
        });
        $('#search_text').val("");

        $("#download_audit_trailid").click(function() {
            window.location.href = "{{route('front.audit-trail-download')}}";
        });

        function getAuditTrailList() {
            blockUI();

            var search_text = $('#search_text').val();

            $.ajax({
                url: "{{route('front.audit-trail-data')}}",
                type: "post",
                dataType: 'json',
                data: {
                    "_token": csrf_token,
                    search_text: search_text,
                },
                success: function(response) {
                    $('#list-section').html(response.html);
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
    });
</script>

@append