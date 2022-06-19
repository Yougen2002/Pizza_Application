@extends('layouts.app')

@section('content')
    <div class="container p-3">
        <h3 class="fs-4 fw-bold "> Type of pizza's </h3>
    </div>
    <div class="container">
        <table class="table table-hover table-bordered table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Ingredients</th>
                     {{-- <th scope="col">Image</th>  --}}
                     <th scope="col">Status</th> 
                    <th scope="col">Actions</th>
                    

                </tr>
            </thead>
            <tbody>
                @foreach ($typeofpizzas as $typeofpizza)
                    <tr>
                      
                        <th scope="row">{{ $typeofpizza->id }}</th>
                        <td>{{ $typeofpizza->name }}</td>
                        <td>{{ $typeofpizza->description }}</td>
                        <td>{{ $typeofpizza->ingredients }}</td>
                        {{-- <td>{{ $typeofpizza->image }}</td> --}}
                     <td>{{ $typeofpizza->is_active ? 'Published' : 'Not Published' }}</td> 
                        <td width="15%">
                            <a class="btn btn-sm btn-outline-success" href="{{ route('typeofpizzas.show', $typeofpizza->id) }}" role="button">View</a>
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('typeofpizzas.edit', $typeofpizza->id) }}"
                                role="button">Edit</a>

                          
                                <form action="{{ route('typeofpizzas.destroy', $typeofpizza->id) }}" method="POST"
                                    id="delete-{{ $typeofpizza->id }}-typeofpizza" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                        onclick="confirm('Are you sure you want to delete user {{ $typeofpizza->name }} ?') ? document.getElementById('delete-{{ $typeofpizza->id }}-typeofpizza').submit() : null">
                                        Delete
                                    </button>
                                </form>
                     
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $typeofpizzas->links() }}
        <div class="col">
            <a class="btn btn-outline-secondary" href="{{ route('typeofpizzas.create') }}">Add Product</a>
        </div>
    @endsection
