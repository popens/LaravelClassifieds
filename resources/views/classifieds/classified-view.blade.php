@extends('layouts.front')

@section('content')
<div class="section-row-header border-bottom bg-light">
    <div class="container">
        <div class="mx-auto pt-3 pb-3">
        	<h2 class="m-0">{{$item->title}}</h2>
        	<p class="lead">{{$item->price}}</p>
        </div>
    </div>
</div>
<div class="section-row-listings mt-5">
    <div class="container">
    	<div class="row">
    		<div class="col-8">
		    	<img src="/uploads/{{$item->image}}">
		    	<p class="text-muted">Posted on: {{$item->created_at}} - Modified on: {{$item->updated_at}}</p>

		    	<h4>Description</h4>
		    	<p>{{$item->description}}</p>
		    </div>
		    <div class="col-4">
		    	SIDEBAR
		    </div>
	    </div>
    </div>
</div>


@endsection
