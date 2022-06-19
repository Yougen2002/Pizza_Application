@extends('layouts.app')

@section('content')
    <div class="container p-3">
        <h3 class="fs-4 fw-bold "> List Of Pizza's Available </h3>
    </div>
    <div class="container">
        <table class="table table-hover table-bordered table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Types of pizza</th>
                   
                    <th scope="col">Size</th>
                    <th scope="col">price</th>
                    <th scope="col">description</th>
                     <th scope="col">Status</th> 
                    <th scope="col">Actions</th>
                    

                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                      
                        <th scope="row">{{ $product->id }}</th>
                        <td>{{ $product->typeofpizza->name}}</td>
                       
                        <td>{{ $product->size }}</td>
                        <td>£{{ $product->price }}</td>
                        <td>{{ $product->description }}</td>
                     <td>{{ $product->is_active ? 'Published' : 'Not Published' }}</td> 
                        <td>
                            <a class="btn btn-sm btn-outline-success" href="{{ route('products.show', $product->id) }}" role="button">View</a>
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('products.edit', $product->id) }}"
                                role="button">Edit</a>

                           
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                    id="delete-{{ $product->id }}-product" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                        onclick="confirm('Are you sure you want to delete user {{ $product->name }} ?') ? document.getElementById('delete-{{ $product->id }}-product').submit() : null">
                                        Delete
                                    </button>
                                </form>
                       
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
     
    @endsection
