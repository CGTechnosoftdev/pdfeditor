<div class="short-by-section">
    <div class="short-checkbox">
        <div class="custom-control custom-checkbox red mr-sm-2">
            <input type="checkbox" class="custom-control-input" id="select-all">
            <label class="custom-control-label font-0" for="select-all">.</label>
        </div>
    </div>
    <div class="short-by">
        <label for="sort_by">Sort By :</label>
        <select id="sort_by" class="form-control my-dropdown">
            <option value="updated_at">Modified-Newest</option>
            <option value="created_at">Newest-Modified</option>
        </select>
    </div>
    <div class="short-btns">
        <ul>
            <li>
                <a href="#"><img src="{{ asset('public/front/images/copy.svg') }}"> Duplicate</a>
            </li>
            <li>
                <a href="#"><img src="{{ asset('public/front/images/rename.svg') }}"> Rename</a>
            </li>
            <li>
                <a href="#" id="move-to-trash-selected"><img src="{{ asset('public/front/images/trash-alt.svg') }}"> Move To Trash</a>
            </li>
            <li>
                <a href="#"><img src="{{ asset('public/front/images/move.svg') }}"> Move</a>
            </li>
            <li>
                <a href="#"><img src="{{ asset('public/front/images/clear-alt.svg') }}"> Clear</a>
            </li>
        </ul>
        <div class="more-opt">
            <div class="btn-group">
                <button id="btnGroupDrop2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-h"></i> More
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop2">
                    <a class="dropdown-item" href="#"><i class="far fa-edit"></i> Open</a>
                    <a class="dropdown-item" href="#"><i class="far fa-copy"></i> Duplicate</a>
                    <a class="dropdown-item" href="#"><i class="far fa-folder"></i> Move</a>
                </div>
            </div>
        </div>

    </div>
</div>