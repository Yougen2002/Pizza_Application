@extends('layouts.app')

@section('content')
    <div class="container">
    
         <form class="row g-3" method="POST" action="{{ route('typeofpizzas.update', $typeofpizzas->id) }}"
            enctype="multipart/form-data"> 
            @method('PUT')
            @csrf
    
            <div class= "shadow p-3 mb-5 bg-body rounded">
                <h4 class="fw-bolder">Edit Types of Pizza</h4>
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        @if ($typeofpizzas->image)
                                  <img src="{{asset('storage/'.$typeofpizzas->image)}}" width="800" height="300"
                                style=" display: block;
                                  margin-left: auto;
                                  margin-right: auto;
                                  width: 50%;">
                                       @endif

                                    </div>
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $typeofpizzas->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control" id="description" name="description" value="{{ $typeofpizzas->description }}">
                                </div>

                                <div class="form-group">
                                    <label for="ingredients">Ingredients</label>
                                    <input type="text" class="form-control" id="ingredients" name="ingredients" value="{{ $typeofpizzas->ingredients }}">
                                </div>

                                <div class="form-group">
                                    <label for="image">image</label>
                                    <input type="file" class="form-control" id="image" name="image" value="{{ $typeofpizzas->image }}">
                                    
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <input type="text" class="form-control" id="is_active" name="pris_activeice" value="{{ $typeofpizzas->is_active ? 'Published' : 'Not Published'}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    <!--Delete button-->
    <div class="col">
        <form action="{{ route('typeofpizzas.destroy', $typeofpizzas->id) }}" method="POST"
            id="delete-{{ $typeofpizzas->id }}-typeofpizza" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-sm btn-outline-danger"
                onclick="confirm('Are you sure you want to delete user {{ $typeofpizzas->name }} ?') ? document.getElementById('delete-{{ $typeofpizzas->id }}-typeofpizza').submit() : null">
                Delete
            </button>
        </form>
    </div>
       
      




        <div class="b-example-divider"></div>


        <div class="container p-5 ">
            <!--div class="d-flex justify-content-between py-4 my-4 border-top">-->
            <footer class="py-5 border-top">
                <div class="row">
                    <div class="col-7">
                        <h3>Section</h3>
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted fs-3">Home</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted fs-3">Features</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted fs-3">Pricing</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted fs-3">FAQs</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted fs-3">About</a></li>
                        </ul>
                    </div>

                    <div class="col-4 offset-1">
                        <form>
                            <h5 class="fs-3">Subscribe to our newsletter</h5>
                            <p class="fs-5">Monthly digest of whats new and exciting from us.</p>
                            <div class="d-flex w-100 gap-2">
                                <label for="newsletter1" class="visually-hidden">Email address</label>
                                <input id="newsletter1" type="text" class="form-control" placeholder="Email address">
                                <button class="btn btn-primary" type="button">Subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="border-top p-5">
                    <p class="fs-5">&copy; 2021 Company, Inc. All rights reserved.</p>
                </div>
            </footer>
        @endsection
