@if(count($documents) > 0)
@foreach($documents as $key => $row)
<div class="single-document single-doc-signed document-container" data-id="{{ $row->encrypted_id }}" id="document_list_item_{{ $row->encrypted_id }}">
    <div class="doc-dots">
        <div class="custom-control custom-checkbox red mr-sm-2">
            <input type="checkbox" value="{{ $row->encrypted_id }}" class="custom-control-input document-checkbox" id="doc-checkbox-{{$key}}">
            <label class="custom-control-label font-0" for="doc-checkbox-{{$key}}">.</label>
        </div>
    </div>
    <div class="doc-status color8 mx-2">
    </div>
    <div class="doc-img">
        <img src="{{ $row->thumbnail_url }}" class="user-image" alt="{{ $row->formatted_name }}">
    </div>
    <div class="doc-content">
        <h5>{{ $row->formatted_name }}</h5>
        <div class="last-activity"><i class="fas fa-calendar-day"></i>{{ changeDateTimeFormat($row->updated_at) }}</div>
    </div>
    <div class="more-opt">
        <div class="btn-group  document-action-menu">
            <button id="btnGroupDrop2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop2">
                <a class="dropdown-item" href="#"><i class="far fa-edit"></i> Open</a>
                <a class="dropdown-item" href="#"><i class="far fa-copy"></i> Duplicate</a>
                <a class="dropdown-item move-to-trash" href="#"><i class=" far fa-folder"></i> Move to trash</a>
                <a class="dropdown-item download_item_trigger" href="#"><i class=" far fa-folder"></i> Download</a>
                <a class="dropdown-item document_print_trigger" href="#"><i class=" far fa-folder"></i> Print</a>
                <a class="dropdown-item document_rename_trigger" href="#"><i class=" far fa-folder"></i> Rename</a>
            </div>
        </div>
    </div>
</div>
@endforeach
@else
<h4>No item found</h4>
@endif