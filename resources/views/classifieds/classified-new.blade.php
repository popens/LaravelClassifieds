@extends('layouts.front')

@section('content')
<div class="section-row-header border-bottom bg-light">
    <div class="container">
        <div class="mx-auto pt-3 pb-3">
            <h2 class="m-0">Add New Lisiting</h5>
        </div>
    </div>
</div>

<div class="section-add-listing">
    <div class="container">
        <div class="form-add-listing w-50 mx-auto pt-5 pb-5">
            <form class="form-horizontal" enctype ="multipart/form-data" method="POST" action="{{ route('add') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title">Title</label>
                    <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>
                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->title('title') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description">Description</label>
                    <textarea id="description" type="text" class="form-control" rows="8" name="description"  required autofocus>{{ old('description') }}</textarea>
                     @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                    <label for="price">Price</label>
                    <input id="price" type="text" class="form-control" name="price" value="{{ old('price') }}">
                    @if ($errors->has('price'))
                        <span class="help-block">
                            <strong>{{ $errors->title('price') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                    <label for="image">Image upload</label>
                    <input id="image" type="file" class="" name="image" value="{{ old('image') }}">
                    @if ($errors->has('image'))
                        <span class="help-block">
                            <strong>{{ $errors->title('image') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Post</button>
            </form>
           
        </div>
    </div>
</div>
@endsection
