@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> <strong>Products</strong> </h2>
        </div>
    </div>
</div>


<div class="row mt-3">
    @foreach ($products as $key => $product)
    <div class="col-sm-4 mb-sm-5" style="height: 100px;">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{$product->title}}</h5>
                <p class="card-text">{{$product->description}}</p>
                <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection