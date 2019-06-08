@extends('layouts.front')

@section('content')
    <div class="section-row-search">
        <div class="container">
            <div class="home-search-container p-5">
                <h1 class="text-center">Search Classifieds</h1>
                <p class="text-center lead">Search from over {ADS COUNT} classifieds & Post unlimited classifieds free!</p>
                <form action="#" method="post" novalidate="novalidate">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                <input type="text" class="form-control search-slt" placeholder="Enter Pickup City">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                <input type="text" class="form-control search-slt" placeholder="Enter Drop City">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                <select class="form-control search-slt" id="exampleFormControlSelect1">
                                    <option>Category</option>
                                    <option value="mobile">Mobile</option>
                                    <option value="vehicle">Vehicle</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                <button type="button" class="btn btn-secondary">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection
