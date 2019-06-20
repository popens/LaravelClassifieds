@extends('layouts.front')
@if(session('info'))
    <div class="alert alert-success">
        {{session('info')}}
    </div>
@endif
@section('content')
    <h2>All Classifieds</h2>

    <ul>
    @foreach($item->all() as $item)
        <li>
        <h3>{{$item->title}}</h3>
            <a href="{{route('editlisting', array($item->id))}}">EDIT</a> | 
            <a href="{{route('deletelisting', array($item->id))}}">DELETE</a> |
             <a href="{{route('viewlisting', array($item->id, $item->slug))}}">VIEW</a>
        </li>
    @endforeach
    </ul>
@endsection