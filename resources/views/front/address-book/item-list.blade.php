@if(count($address_book_items)>0)
{{ Form::open(['url' => '#','method'=>'post','class'=>'dropzone2 needsclick','id' => 'addressbook-formid','enctype'=>"multipart/form-data"]) }}
{{Form::hidden('sort_by',"",array('id' => 'sort_by_id'))}}
@foreach($address_book_items as $row)
<div class="single-document single-doc-signed">
    <div class="doc-dots">
        <div class="custom-control custom-checkbox red mr-sm-2">

            {{Form::checkbox("address_book_item[$row->id]",1,false,array("value" => 1,"class" => "custom-control-input newcustom_trashList_$row->id","id" => "customControlAutosizing".$row->id,"checked" => false))}}
            <label class="custom-control-label font-0" for="customControlAutosizing{{$row->id}}">.</label>
        </div>
    </div>
    <div class="doc-img"><img src="{{asset('public/front/images/doc-img-1.png')}}" class="user-image" alt="PDFWriter Admin Image"></div>
    <div class="doc-content">
        <h5>{{$row->name}}</h5>
        <div class=" last-activity"><i class="fas fa-calendar-day"></i> {{ changeDateTimeFormat($row->updated_at) }}</div>
    </div>
    <div class="more-opt">
        <div class="btn-group">
            <button id="btnGroupDrop2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop2">
                <a class="dropdown-item" href="#" data-id="{{$row->id}}" id="deleteAddressItem_{{$row->id}}"><i class="far fa-edit"></i> Delete</a>
                <a class="dropdown-item" href="#" data-id="{{$row->id}}" id="editAddressItem_{{$row->id}}"><i class="far fa-edit"></i> Edit</a>
                <!--<a class="dropdown-item" href="#"><i class="far fa-copy"></i> Quick Preview</a>-->
            </div>
        </div>
    </div>
</div>
@endforeach
{{ Form::close() }}
@else
<div class="recent-documents">
    <h4>No record found</h4>
</div>
@endif