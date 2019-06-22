@extends('layouts.front')

@if(session('info'))
    <div class="alert alert-success">
        {{session('info')}}
    </div>
@endif

@section('content')
<div class="section-row-header border-bottom bg-light">
    <div class="container">
        <div class="mx-auto pt-3 pb-3">
            <h2 class="m-0">All Classifieds</h5>
        </div>
    </div>
</div>

<div class="section-row-listings mt-5">
    <div class="container">
    @if ($item->count() >= 1)
        <!-- All listings -->
        <div class="row">
            @foreach($item->all() as $item)
            <div class="card border-bottom rounded-0 mb-3 w-100">
                <div class="row no-gutters">
                    <div class="col-2">
                        @if (@empty($item->image))
                            <img src="{{ url('images/no-image.png') }}" class="card-img rounded-0" alt="">
                        @else
                            <img src="/uploads/{{$item->image}}" class="card-img rounded-0" alt="">
                        @endif
                    </div>
                    <div class="col p-3">
                        <h4 class="mt-0">{{$item->title}}</h4>
                        <a href="{{route('viewlisting', array($item->id, $item->slug))}}">VIEW</a>
                        <a href="{{route('editlisting', array($item->id))}}">EDIT</a>
                        <a href="{{route('deletelisting', array($item->id))}}">DELETE</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <!-- No results -->
        <div class="pt-5 pb-5">
            <p>No listings found!</p>
        </div>
    @endif
    </div>
</div>
@endsection