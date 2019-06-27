@extends('layouts.front')

@section('content')
    <div class="section-row-search bg-light">
        <div class="container home-search-container pt-5 pb-5">
            <h1 class="text-center">Search Classifieds</h1>
            <p class="text-center lead">Search from over {ADS COUNT} classifieds & Post unlimited classifieds free!</p>
            <form action="{{route('searchlisting')}}" method="get" class="home-search-form">
                <div class="input-group input-group-lg">
                    <input name="keyword" type="text" class="form-control" placeholder="Keyword...">
                     <select class="form-control">
                        <option>Category</option>
                    </select>
                    <div class="input-group-prepend">
                        <button type="submit" class="btn btn-secondary">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
