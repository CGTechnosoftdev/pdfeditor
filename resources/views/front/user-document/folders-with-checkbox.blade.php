@if(count($documents) > 0)
@foreach($documents as $key => $row)
<div class="single-document single-doc-signed" data-folder="{{ $row->id }}">
    <div class="doc-dots">
        <div class="custom-control custom-checkbox red mr-sm-2">
            <input type="checkbox" value="{{ $row->id }}" class="custom-control-input document-checkbox" id="doc-checkbox-{{$key}}">
            <label class="custom-control-label font-0" for="doc-checkbox-{{$key}}">.</label>
        </div>
    </div>
    <div class="doc-img"><img src="{{ asset('public/front/images/folder.svg') }}" class="user-image" alt="PDFWriter Admin Image"></div>
    <div class="doc-content">
        <h5>{{$row->name}}</h5>
        <div class="last-activity">{{$row->document_count}} Documents</div>
    </div>
    <div class="more-opt">
        <div class="btn-group">
            <button id="btnGroupDrop2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop2">
                <a class="dropdown-item" href="{{route('front.smart-folder-documents',$row->id)}}"><img src="{{ asset('public/front/images/edit-smart.svg') }}" class="user-image" alt="Open Smart Folder"> Open Folder</a>
                <a class="dropdown-item" href="#"><img src="{{ asset('public/front/images/edit-smart.svg') }}" class="user-image" alt="Edit Smart Folder"> Edit Smart Folder</a>
                <a class="dropdown-item delete-smart-folder" href="#"><img src="{{ asset('public/front/images/trash-colored.svg') }}" class="user-image" alt="Delete Smart Folder"> Delete Smart Folder</a>
            </div>
        </div>
    </div>
</div>
@endforeach
@else
<h4>No item found</h4>
@endif