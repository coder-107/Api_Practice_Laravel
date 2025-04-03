@extends('layouts.admin')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<div class="card">
    <div class="card-header">
        <h2><strong>Detailed Post</strong></h2>
        <span>Post ID: {{$findpost->id}}</span>
        <a href="{{route('blog.home')}}" class="btn btn-primary float-end p-2">Back</a>
    </div>
    <div class="card-body">
        <div class="col-sm-4 float-end">
            <img src="/{{$findpost->images}}" alt="{{$findpost->title}}" width="200px">
        </div>
        <label class="text-danger">Post Title </label>
        <h4 class="mb-5">{{$findpost->title}}</h4>
        <label class="text-danger">Post Description </label>
        <p>{{$findpost->description}}</p>
    </div>
</div>
@endsection