@if(count($documents) > 0)
@foreach($documents as $key => $row)
<div class="single-document" data-id="{{ $row->encrypted_id }}" id="document_list_item_<?= $row->id ?>">
    <div class="doc-img">
        <img src="{{ $row->thumbnail_url }}" class="user-image" alt="{{ $row->formatted_name }}">
    </div>
    <div class="doc-content">
        <h5>{{ $row->formatted_name }}</h5>
        <div class="last-activity">Last activity: <strong>You opened {{ $row->name }}</strong></div>
        <dtv class="tags">
            <span class="tag badge badge-warning">GuideBook</span>
            <a href="" class="add-tag">
                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                    <g>
                        <g>
                            <path d="M256,0C114.833,0,0,114.833,0,256s114.833,256,256,256s256-114.853,256-256S397.167,0,256,0z M256,472.341 c-119.275,0-216.341-97.046-216.341-216.341S136.725,39.659,256,39.659S472.341,136.705,472.341,256S375.295,472.341,256,472.341z " />
                        </g>
                    </g>
                    <g>
                        <g>
                            <path d="M355.148,234.386H275.83v-79.318c0-10.946-8.864-19.83-19.83-19.83s-19.83,8.884-19.83,19.83v79.318h-79.318 c-10.966,0-19.83,8.884-19.83,19.83s8.864,19.83,19.83,19.83h79.318v79.318c0,10.946,8.864,19.83,19.83,19.83 s19.83-8.884,19.83-19.83v-79.318h79.318c10.966,0,19.83-8.884,19.83-19.83S366.114,234.386,355.148,234.386z" />
                        </g>
                    </g>
                    <g> </g>
                    <g> </g>
                    <g> </g>
                    <g> </g>
                    <g> </g>
                    <g> </g>
                    <g> </g>
                    <g> </g>
                    <g> </g>
                    <g> </g>
                    <g> </g>
                    <g> </g>
                    <g> </g>
                    <g> </g>
                    <g> </g>
                </svg> Add tag
            </a>
        </dtv>
    </div>
    <div class="doc-date-and-dismiss">
        <div class="doc-date">
            <i class="fas fa-calendar-day"></i> {{ changeDateTimeFormat($row->updated_at) }}
        </div>
        <button id="btnGroupDrop{{$key}}" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop{{$key}}">
            <a class="dropdown-item" href="#"><i class="far fa-edit"></i> Open</a>
            <a class="dropdown-item" href="#"><i class="far fa-copy"></i> Duplicate</a>
            <a class="dropdown-item" href="#"><i class="far fa-folder"></i> Move</a>
        </div>
    </div>
</div>
@endforeach
@else
<h3>No item found</h3>
@endif

<!-- <div class="single-document free-trial-document">
    <div class="doc-img">
        <h4><strong>Free</strong> Trial</h4>
    </div>
    <div class="doc-content">
        <h5>Get PDFwriter For FREE. Fill and edit documents Signed.pdf</h5>
        <dtv class="tags">
            <ul>
                <li>Print</li>
                <li>-</li>
                <li>Save as</li>
                <li>-</li>
                <li>Email</li>
                <li>-</li>
                <li>E-Sign</li>
                <li>-</li>
                <li>Fax</li>
                <li>-</li>
                <li>Share</li>
            </ul>
        </dtv>
    </div>
    <div class="doc-date-and-dismiss">
        <div class="start-days-trial">Start 30 Days Free Trial</div>
        <button><i class="fas fa-times"></i></button>
    </div>
</div> -->