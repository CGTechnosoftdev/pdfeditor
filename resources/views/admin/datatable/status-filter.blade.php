@php
$statusArr = $statusArr ?? config('custom_config.status_arr');
@endphp
<div class="pull-right">&nbsp;<label>Status:</label> &nbsp;<select class="form-control input-sm" id="status_dropdown"><option value="">All</option>@foreach($statusArr as $statusKey => $statusValue)<option value="{{$statusKey}}">{{$statusValue}}</option>@endforeach</select></div>