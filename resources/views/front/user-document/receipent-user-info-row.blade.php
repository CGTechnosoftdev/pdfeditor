<div class="recipients-user-info">
    <input type="hidden" name="recipient_data[name][]" value="{{$input_data['name']}}">
    <input type="hidden" name="recipient_data[email][]" value="{{$input_data['email']}}">
    <div class="user-img"><img src="{{ asset('public/front/images/avatar.svg') }}" class="user-image" alt="PDFWriter Admin Image"></div>
    <div class="user-content">
        <h5>{{$input_data['name']}}</h5>
        <div class="last-activity">{{$input_data['email']}}</div>
    </div>
    <div class="user-date-and-dismiss">
        <div class="user-date">
            <i class="fas fa-bell"></i>
            <select class="my-dropdown" name="recipient_data[notify_status][]">
                @foreach($notify_status as $key => $value)
                <option value="{{$key}}">{{$value}}</option>
                @endforeach
            </select>
        </div>
        <div class="user-date">
            <i class="fas fa-pencil-alt"></i>
            <select class="my-dropdown" name="recipient_data[document_operations][]">
                @foreach($document_operations as $key => $value)
                <option value="{{$key}}">{{$value}}</option>
                @endforeach
            </select>
        </div>

        <button><i class="fas fa-times remove-recipient"></i></button>
    </div>
</div>