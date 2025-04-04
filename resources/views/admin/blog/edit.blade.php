@extends('layouts.admin')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Post</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary m-2" href="{{ route('blog.home') }}"> Back</a>
        </div>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{route('blog.update', $posts->id)}}" method="post" enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <strong>Title</strong>
                <input type="text" name="title" class="form-control" placeholder="Name" value="{{$posts->title}}">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <strong class="mb-2">Upload Image:</strong>
                <input type="file" class="form-control" id="images" name="images">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                <textarea class="form-control" style="height: 150px" name="description" placeholder="Description">{{$posts->description}}</textarea>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="status" value="Active" {{ $posts->status == 'Active' ? 'checked' : '' }}>
                <label class="form-check-label" for="status">Active</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="status" value="Inactive" {{ $posts->status == 'Inactive' ? 'checked' : '' }}>
                <label class="form-check-label" for="status">Inactive</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="status" value="Draft" {{ $posts->status == 'Draft' ? 'checked' : '' }}>
                <label class="form-check-label" for="status">Draft</label>
            </div>
            <button type="submit" class="btn btn-primary float-end">Update</button>
        </div>

        <div class="col-md-12">
            <img src="/{{$posts->images}}" alt="{{$posts->title}}" width="150px">
        </div>
    </div>
</form>
@endsection