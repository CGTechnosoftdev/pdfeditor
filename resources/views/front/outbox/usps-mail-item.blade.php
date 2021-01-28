@if(count($documents) > 0)
@foreach($documents as $key => $row)
<div class="single-document single-doc-signed" data-id="{{ $row->id }}">
    <div class="doc-dots">
        <div class="custom-control custom-checkbox red mr-sm-2">
            <input type="checkbox" value="{{ $row->id }}" class="custom-control-input document-checkbox" id="doc-checkbox-{{$key}}">
            <label class="custom-control-label font-0" for="doc-checkbox-{{$key}}">.</label>
        </div>
    </div>
    <div class="doc-img circle"><img src="{{ asset('public/front/images/default-user-picture.png') }}" class="user-image" alt="{{$row->to_name}}"></div>
    <div class="doc-content">
        <h5>{{ $row->to_name }}</h5>
        <div class="last-activity"><i class="fas fa-calendar-day"></i> {{ changeDateTimeFormat($row->updated_at) }}</div>
    </div>
    <div class="more-opt">
        <div class="btn-group">
            <button id="btnGroupDrop2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop2">
                <a class="dropdown-item" href="#" id="delete-item"><i class="fa fa-trash"></i> Delete</a>
            </div>
        </div>
    </div>
</div>
@endforeach
@else
<h4>No item found</h4>
@endif