@if(count($items) > 0)
@foreach($items as $key => $row)
<div class="single-document sharelink-1" data-id="{{ $row->id }}">
    <div class="doc-dots">
        <div class="custom-control custom-checkbox red mr-sm-2">
            <input type="checkbox" value="{{ $row->id }}" class="custom-control-input document-checkbox" id="doc-checkbox-{{$key}}">
            <label class="custom-control-label font-0" for="doc-checkbox-{{$key}}">.</label>
        </div>
    </div>
    <div class="doc-img"><img src="{{ asset('public/front/images/doc-img-1.png') }}" class="user-image" alt="PDFWriter Admin Image"></div>
    <div class="doc-content">
        <h5>{{ $row->shared_document_name }}</h5>
        <div class="last-activity"><i class="fas fa-calendar-day"></i> {{ changeDateTimeFormat($row->updated_at) }}</div>
    </div>
    <div class="more-opt">
        <div class="btn-group">
            <button id="btnGroupDrop2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                <a class="dropdown-item delete-item" href="#"><i class="fa fa-trash"></i> Delete</a>
            </div>
        </div>
    </div>
</div>
@endforeach
@else
<h4>No item found</h4>
@endif