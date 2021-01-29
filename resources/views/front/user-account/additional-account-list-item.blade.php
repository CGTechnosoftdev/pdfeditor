@if(count($items) > 0)
@foreach($items as $key => $row)
<tr data-id="{{ $row->id }}" class="single-item">
    <td>
        <div class="custom-control custom-checkbox red mr-sm-2">
            <input type="checkbox" value="{{ $row->id }}" class="custom-control-input document-checkbox" id="doc-checkbox-{{$key}}">
            <label class="custom-control-label font-0" for="doc-checkbox-{{$key}}">.</label>
        </div>
    </td>
    <td>
        <div class="name-icon color1">{{$row->getInitials()}}</div>
        <div class="usr-name">{{$row->full_name}}</div>
    </td>
    <td>{{$row->email}}</td>
    <td>{{$row->contact_number}}</td>
    <td>
        <div class="tg-list-item blue-radio change-status">
            <input class="tgl tgl-light" id="cb0" {{ $row->status == config('constant.STATUS_ACTIVE') ? "checked" : '' }} type="checkbox">
            <label class="tgl-btn btn-sm" for="cb0"></label>
        </div>

    </td>
    <td>
        <a href="" class="btn text-primary edit-item"><i class="fas fa-pencil-alt"></i></a>
        <a href="" class="btn text-danger delete-item"><i class="fas fa-trash"></i></a>
    </td>
</tr>
@endforeach
@else
<tr>
    <td colspan="6" class="text-center">No record found</td>
</tr>
@endif