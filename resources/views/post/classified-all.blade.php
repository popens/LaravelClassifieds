@extends('layouts.app')

@section('content')
<h2>All Classifieds</h2>
@if(count($classifieds > 0))
    <ul>
    @foreach($classifieds->all as $classified)
        <li><h3>{{$classified->title}}</h3></li>
    @endforeach
    </ul>
@endif



@endsection