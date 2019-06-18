@extends('layouts.front')

@section('content')
<div class="section-row-header border-bottom bg-light">
    <div class="container">
        <div class="mx-auto pt-3 pb-3">
            <h2 class="m-0">My Account</h5>
        </div>
    </div>
</div>

<div class="section-row-content pt-5 pb-5">
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        
        <h3>Dashboard</h3>
        <div class="row">
            <div class="col-3">
                Usermenus
            </div>
            <div class="col-9">
                You are logged in!
            </div>
        </div>
    </div>
</div>
@endsection
