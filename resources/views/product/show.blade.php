@extends('layouts.app')

@section('content')
<div class="container">
<div class="card row g-1 shadow p-0 mb-5 bg-body rounded" ">

    <ul class="list-group list-group-flush">
        <li class="list-group-item list-group-item-action ">Product ID: {{ $products->id}}</li> 
        <li class="list-group-item list-group-item-action ">Pizza Type: {{$products->typeofpizza->name}}</li> 
        <li class="list-group-item list-group-item-action">Size: {{ucfirst( $products->size )}}</li>
     <li class="list-group-item list-group-item-action ">Price: £{{ $products->price}}</li>
      <li class="list-group-item list-group-item-action ">Description: {{ $products->description}}</li>
      <li class="list-group-item list-group-item-action "> {{$products->image}}</li>
      <li class="list-group-item list-group-item-action ">Status: {{ $products->is_active ? 'Published' : 'Not Published' }}</li>

    </ul>
    @can('FeaturesForAdmin')
    <div class="card-body">
        <a class="btn btn-sm btn-outline-primary" href="{{ route('products.edit', $products->id) }}"
            role="button">Edit</a>
            
    </div>
    @endcan
  </div>
</div>
@endsection
