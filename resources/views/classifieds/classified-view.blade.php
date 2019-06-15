@extends('layouts.front')
@section('content')
<h2>{{$item->title}}</h2>
<p>{{$item->description}}</p>
<p>{{$item->price}}</p>
<p>{{$item->created_at}} - {{$item->updated_at}}</p>
@endsection
