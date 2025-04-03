@extends('layouts.admin')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Blog Post Managment</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success m-2" href="{{ route('blog.create') }}"> Create New Product</a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>#</th>
        <th>Title</th>
        <th>Description</th>
        <th>Images</th>
        <th>Status</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($posts as $i => $post)
    <tr>
        <td>{{ ++$i }}</td>
        <td class="text-center">{{ $post->title }}</td>
        <td>{{ Str::limit($post->description, 10) }}</td>
        <td><img src="{{$post->images}}" alt="{{$post->title}}" width="90px" height="50px"></td>
        <td class="text-center">
            @if($post->status == 'Active')
            <span class="badge rounded-pill text-bg-success">{{$post->status}}</span>
            @elseif($post->status == 'Draft')
            <span class="badge rounded-pill text-bg-warning">{{$post->status}}</span>
            @else
            <span class="badge rounded-pill text-bg-danger">{{$post->status}}</span>
            @endif
        </td>
        <td>
            <form action="{{ route('blog.delete',$post->id) }}" method="POST">
                <a class="btn btn-info" href="{{ route('blog.show',$post->id) }}">Show</a>
                @can('product-edit')
                <a class="btn btn-primary" href="{{ route('blog.edit',$post->id) }}">Edit</a>
                @endcan
                @csrf
                @method('DELETE')
                @can('product-delete')
                <button type="submit" class="btn btn-danger">Delete</button>
                @endcan
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection