@if(count($address_book_items)>0)
{{ Form::open(['url' => '#','method'=>'post','class'=>'dropzone2 needsclick','id' => 'addressbook-formid','enctype'=>"multipart/form-data"]) }}
{{Form::hidden('sort_by',"",array('id' => 'sort_by_id'))}}

<div class="table-card">
    <div class="table-responsive">
        <table class="table multi-active-tr">
            <thead>
                <tr>
                    <th class="select-all" scope="col">
                        <div class="custom-control custom-checkbox red mr-sm-2">
                            <input type="checkbox" class="custom-control-input" id="select-all">
                            <label class="custom-control-label font-0" for="select-all">.</label>
                        </div>
                    </th>
                    <th class="name" scope="col">Name</th>
                    <th class="email" scope="col">Email</th>
                    <th class="phone" scope="col">Phone</th>
                    <th class="fax" scope="col">Fax</th>
                    <th class="action" scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach($address_book_items as $row)
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox red mr-sm-2">
                            {{Form::checkbox("address_book_item[$row->id]",1,false,array("value" => 1,"class" => "custom-control-input newcustom_trashList_$row->id","id" => "customControlAutosizing".$row->id,"checked" => false))}}
                            <label class="custom-control-label font-0" for="customControlAutosizing{{$row->id}}">.</label>
                        </div>
                    </td>
                    <td>
                        <div class="name-icon color2">{{ (!empty($row->name)?substr($row->name,0,2):"")}}</div>
                        <div class="usr-name"> {{$row->name}}</div>
                    </td>
                    <td>{{$row->email}}</td>
                    <td>{{$row->phone}}</td>
                    <td>{{$row->fax}}</td>
                    <td>
                        <a class="btn text-danger" href="#" data-id="{{$row->id}}" id="editAddressItem_{{$row->id}}"><i class="fas fa-pencil-alt"></i> </a>
                        <a class="btn text-primary" href="#" data-id="{{$row->id}}" id="deleteAddressItem_{{$row->id}}"><i class="fas fa-trash"></i> </a>

                    </td>
                </tr>
                @endforeach
                {{ Form::close() }}
                @else
                <div class="recent-documents">
                    <h4>No record found</h4>
                </div>
                @endif
            </tbody>

        </table>
    </div>
</div>


<script>
    $(document).ready(function() {



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