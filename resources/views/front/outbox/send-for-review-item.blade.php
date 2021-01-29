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
        <ul class="share-to">
            <li>
                <div class="last-activity"><i class="fas fa-calendar-day"></i> {{ changeDateTimeFormat($row->updated_at) }}</div>
            </li>
            <li>
                <div class="last-activity"><i class="fas fa-share-alt"></i>
                    @if(empty($row->shared_with_name))
                    Shared via Link
                    @else
                    Shared to : <a href="#">{{$row->shared_with_name}}</a>
                    @endif
                </div>
            </li>
        </ul>
    </div>
    <div class="doc-date-and-dismiss">
        @if($row->status == config('constant.STATUS_ACTIVE'))
        <button class="btn doc-date blue-text stop-sharing"><i class="fas fa-stop-circle"></i> Stop Sharing</button>
        @else
        &nbsp;
        @endif
        <div class="btn-group more-opt">
            <button id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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