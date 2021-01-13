@extends('layouts.front-user')
@section('title',($title ?? ''))
@section("content")
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="title">
        <h2>Trash Bin</h2>
        <span>{{$trash_count}} Items</span>
    </div>
    <div class="heading-btns">
        @include('front.partials.forms.add-new-dropdown')
        {{ Form::open(['url' => '#','method'=>'post','class'=>'','id' => 'trash-searchformid','enctype'=>"multipart/form-data"]) }}

        <div class="input-group input-group-joined input-group-solid ml-3">
            <!--<input class="form-control mr-sm-0" type="search" placeholder="Search" aria-label="Search">-->
            {{form::text('search_text',$search_text,['id'=>'trash_search_boxid','class' => 'form-control mr-sm-0','placeholder' => 'Search'])}}
            <div class="input-group-append">
                <button class="input-group-text" id="trash_search_triggerid"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg></button>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</section>
@if(!empty($trash_count))
<div class="short-by-section">
    <div class="short-checkbox">
        <div class="custom-control custom-checkbox red mr-sm-2" id="selectAllId2">
            <input type="checkbox" class="custom-control-input" id="select-all">
            <label class="custom-control-label font-0" for="select-all">Select All</label>
        </div>
    </div>
    <div class="short-by">
        <label for="folder">Sort By :</label>
        <select id="folder" class="form-control my-dropdown">
            <option value="Option 1">Option 1</option>
            <option value="Option 2">Option 2</option>
            <option value="Option 3">Option 3</option>
            <option value="Option 4">Option 4</option>
            <option value="Option 5">Option 5</option>
        </select>
    </div>
    <div class="short-btns">
        <ul>
            <li>
                <a href="#" id="restore_selectedId"><img src="{{asset('public/front/images/copy.svg')}}"> Restore Selected</a>
            </li>
            <li>
                <a href="#" id="delete_selectedId"><img src="{{asset('public/front/images/rename.svg')}}"> Deleted Selected</a>
            </li>
        </ul>
        <div class="more-opt">
            <button id="empty_trashlistId"><img src="{{asset('public/front/images/empty-trash.svg')}}"> Empty Trash</button>
        </div>

    </div>
</div>
<!-- Main content -->
<section class="content">
    {{ Form::open(['url' => '#','method'=>'post','class'=>'dropzone2 needsclick','id' => 'trash-formid','enctype'=>"multipart/form-data"]) }}
    {{Form::hidden('req_type',"",array('id' => 'trash_req_type_id'))}}
    @foreach($trash_items as $row)
    <div class="single-document single-doc-signed">
        <div class="doc-dots">
            <div class="custom-control custom-checkbox red mr-sm-2">

                {{Form::checkbox("trash_items[$row->id]",1,false,array("value" => 1,"class" => "custom-control-input newcustom_trashList_$row->id","id" => "customControlAutosizing".$row->id,"checked" => false))}}
                <label class="custom-control-label font-0" for="customControlAutosizing{{$row->id}}">.</label>
            </div>
        </div>
        <div class="doc-status color4 mx-2">
            <!--<span class="badge badge-primary"></span>-->
        </div>
        <div class="doc-img"><img src="{{asset('public/front/images/doc-img-1.png')}}" class="user-image" alt="PDFWriter Admin Image"></div>
        <div class="doc-content">
            <h5>{{$row->formatted_name}}</h5>
            <div class=" last-activity"><i class="fas fa-calendar-day"></i> {{ changeDateTimeFormat($row->updated_at) }}</div>
        </div>
        <div class="more-opt">
            <div class="btn-group">
                <button id="btnGroupDrop2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop2">
                    <a class="dropdown-item" href="#"><i class="far fa-edit"></i> Restore</a>
                    <a class="dropdown-item" href="#"><i class="far fa-copy"></i> Quick Preview</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    {{ Form::close() }}
</section>
@else
<div class="recent-documents">
    <h4>No record found</h4>
</div>
@endif
@endsection
@section('additionaljs')
<script>
    $(document).ready(function() {
        $("body").on("click", "#restore_selectedId", function() {
            var req_type = "{{config('constant.RESTORE_FORM')}}";
            $("#trash_req_type_id").val(req_type);
            var form = $("#trash-formid");
            form.attr({
                "action": "{{route('front.trash-update-save')}}"
            });
            form.submit();
        });

        $("body").on("click", "#delete_selectedId", function() {
            var req_type = "{{config('constant.DESTROY_FORM')}}";
            $("#trash_req_type_id").val(req_type);
            var form = $("#trash-formid");
            form.attr({
                "action": "{{route('front.trash-update-save')}}"
            });
            form.submit();
        });
        $("body").on("click", "#empty_trashlistId", function() {

            if (confirm("Are you sure you want to empty the trash list?")) {
                var form = $("#trash-formid");
                form.attr({
                    "action": "{{route('front.trash-empty-save')}}"
                });
                form.submit();

            }


        });

        $("body").on("click", "#trash_search_triggerid", function() {

            if ($("#trash_search_boxid").val() != "") {

                var form = $("#trash-searchformid");
                form.attr({
                    "action": "{{route('front.trash-list')}}"
                });
                form.submit();
            }





        });



        /* $("#selectAllId2").change(function() {
             // alert("tt");
             $("input[id ^= 'customControlAutosizing']").each(function(key, val) {
                 if ($(this).attr("checked")) {
                     // alert("checked");
                     $(this).attr({
                         "checked": false
                     });
                 } else {
                     //  alert("unchecked");
                     $(this).attr({
                         "checked": true
                     });
                 }
             })
         });*/


        var selectAllItems = "#select-all";
        var checkboxItem = ":checkbox";

        $(selectAllItems).click(function() {

            if (this.checked) {
                $(checkboxItem).each(function() {
                    this.checked = true;
                });
            } else {
                $(checkboxItem).each(function() {
                    this.checked = false;
                });
            }

        });


    });
</script>

@append