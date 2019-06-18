@extends('layouts.front')

@section('content')
<div class="section-row-login bg-light">
    <div class="container">
        <div class="form-login w-25 mx-auto pt-5 pb-5">
            <h2>Edit Listings</h2>
            <form class="form-horizontal" method="POST"  enctype ="multipart/form-data" action="{{ route('update', array($item->id)) }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title">Title</label>
                    <input id="title" type="text" class="form-control" name="title" value="{{$item->title}}" required autofocus>
                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->title('title') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description">Description</label>
                    <textarea id="description" type="text" class="form-control" name="description"  required autofocus>{{$item->description}}</textarea>
                    @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                    <label for="price">Price</label>
                    <input id="price" type="text" class="form-control" name="price" value="{{$item->price}}">
                    @if ($errors->has('price'))
                        <span class="help-block">
                            <strong>{{ $errors->title('price') }}</strong>
                        </span>
                    @endif
                </div>
               @if($item->image)
                    <div class="form-group">
                    <label>Image already uploaded</label>
                        <img width="150" src="{{url('images', array($item->image))}} ">
                        <a href="{{route('deleteimage', array($item->id, $item->image))}}">Delete</a>
                    </div>
               @endif
                <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                    <label for="image">Image upload</label>
                    <input id="image" type="file" class="" name="image" value="{{ old('image') }}">
                    @if ($errors->has('image'))
                        <span class="help-block">
                            <strong>{{ $errors->title('image') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
