@extends('layouts.app')

@section('content')
<div class="container">
<div class="card row g-1 shadow p-0 mb-5 bg-body rounded" ">

  @if ($typeofpizzas->image)
  <img src="{{asset('storage/'.$typeofpizzas->image)}}" width="1290" height="500" >
  @endif

    <ul class="list-group list-group-flush">
        <li class="list-group-item list-group-item-action ">Pizza type ID: {{ $typeofpizzas->id}}</li> 
        <li class="list-group-item list-group-item-action ">Name: {{$typeofpizzas->name}}</li>
        
       

        <li class="list-group-item list-group-item-action ">Description: {{ $typeofpizzas->description}}</li>
        <li class="list-group-item list-group-item-action">Ingredient: {{ucfirst( $typeofpizzas->ingredients )}}</li>

      <li class="list-group-item list-group-item-action ">Status: {{ $typeofpizzas->is_active ? 'Published' : 'Not Published' }}</li>

    </ul>
    <div class="card-body">
        <a class="btn btn-sm btn-outline-primary" href="{{ route('typeofpizzas.edit', $typeofpizzas->id) }}"
            role="button">Edit</a>
            
    </div>
  </div>
</div>
@endsection
