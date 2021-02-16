@if(count($audit_trail_items)>0)
<div class="timeline-container">
    <ul id="first-list">
        @foreach($audit_trail_items as $audit_date => $day_wise_entry_array)
        <li class="month">
            <div class="time">
                <span class="day">{{date("D",strtotime($audit_date))}}</span>
                <span class="month">{{date("M",strtotime($audit_date))}}</span>
            </div>
            <span class="trial-date">{{date("d",strtotime($audit_date))}}</span>
        </li>
        @foreach($day_wise_entry_array as $audit_id => $audit_info_array)
        <li>
            <span class="color{{$audit_info_array['class']}}"><img src="{{asset('public/front/images/'.$audit_info_array['icon_file'])}}"></span>
            <div class="time">
                <span>{{changeTimeFormat(strtotime($audit_info_array["date"]),"h:i A")}}</span>
            </div>
            <div class="content">
                {{$audit_info_array["description"]}}
            </div>
        </li>
        @endforeach

        @endforeach

    </ul>
</div>
@else
No Item found in audit trail,thank you.
@endif