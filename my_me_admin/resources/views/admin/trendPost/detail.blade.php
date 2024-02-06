@extends('admin.layouts.app')
@section('content')
   <div class="col-6 offset-3 mt-5">
    <a href="">
        <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>
    </a>
    <div class="card-header">
        <div class="text-center">
<img class="roundered shadow" width="400px"

@if ($post['image'] == null) src="{{asset('defaultImage/Screenshot (176).png')}}"  
@else
src="{{asset('postImage/'.$item['image'])}}"
@endif>
</div>
    </div>
    <div class="card-body">
        <div class="text-center">{{$post['title']}}</div>
        <div class="text-start">{{$post['description']}}</div>
    </div>
   </div>
@endsection