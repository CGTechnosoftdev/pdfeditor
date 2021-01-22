@extends('layouts.front-user')

@section("content")
<h2>To get google contacts , click bellow link!</h2>
@if(!empty($viewData["message"]))
<div class="alert alert-success">
    {{$viewData["message"]}}
</div>
@endif
Get google contact page
<a href="{{$viewData["googleImportUrl"]}}">GetGoogle contacts</a>
@endsection("content")