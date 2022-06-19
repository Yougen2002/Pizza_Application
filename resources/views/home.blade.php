@extends('layouts.app')

<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
@section('content')
    <section id="myCarousel" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="bd-placeholder-img" width="100%" height="80%" src="{{ asset('/images/pizza7.jpg') }}"
                    aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                <div class="container">

                    <div class="carousel-caption text-start">
                        <h1 class="featurette-heading ">PIZZA BREEZE.</h1>
                        <p class="featurette-heading ">Order your delicious pizza now through our web portal.</p>
                        <!-- <p><a class="btn btn-lg btn-primary" href="{{ route('users.create') }}">Sign up today</a></p>-->
                        @can('FeaturesForCustomer')
                        <a class="btn btn-primary" 
                                            href="{{ route('orders.history') }}">View Your Order history</a>
                        @endcan
                        @can('FeaturesForAdmin')
                        <a class="btn btn-primary" 
                                            href="{{ route('orders.history') }}">View Your Order history</a>
                        @endcan
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <img class="bd-placeholder-img" width="100%" height="80%" src="{{ asset('/images/pizza2.jpg') }}"
                    aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                <div class="container">
                    <div class="carousel-caption">
                        <h1 class="fw-bold text-dark">Our Deals</h1>
                        <p class="fw-bold text-dark fs-4">Some representative placeholder content for the second slide of
                            the carousel.</p>
                        <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="bd-placeholder-img" width="100%" height="80%" src="{{ asset('/images/pizza4.jpg') }}"
                    aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">

                <div class="container">
                    <div class="carousel-caption text-end">
                        <h1>One more for good measure.</h1>
                        <p>Some representative placeholder content for the third slide of this carousel.</p>
                        <p><a class="btn btn-lg btn-primary" href="{{ route('contact') }}">Contact Us</a></p>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </section>



    <!--======Deals and offers====-->
    <!--div1-->
    <section class="container pt-5">

        <!--msubdiv1-->
        <div class="row">
            <h1 class="fs-2 fw-bold text-dark ">Pizza's</h1>
            <div class="col-lg-4">


            </div>

            @if ($products && $products->count())
                @foreach ($products as $product)
             
                    <div class=" row g-1 shadow p-0 mb-5 bg-body rounded">

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item list-group-item-action ">Product ID: {{ $product->id }}</li>
                            <li class="list-group-item list-group-item-action "><img src="{{ $product->image }}"
                                    class="img-fluid img-responsive rounded product-image" width="300" height="300" style=" display: block;
                                    margin-left: auto;
                                    margin-right: auto;
                                    width: 50%;"></li>
                            <li class="list-group-item list-group-item-action ">Pizza Type:
                                {{ $product->typeofpizza->name }}</li>
                            <li class="list-group-item list-group-item-action">Size: {{ ucfirst($product->size) }}</li>
                            <li class="list-group-item list-group-item-action ">Price: £{{ $product->price }}</li>

                            <li class="list-group-item list-group-item-action ">Description: {{ $product->description }}
                            </li>
                            <li class="list-group-item list-group-item-action ">Status:
                                {{ $product->is_active ? 'Published' : 'Not Published' }}</li>
                              
                            
                                       
                         

                        </ul>
                        @auth
                            
                      

                        <form action="{{ route('cart.store') }}" method="POST">
                            @csrf

                            @if ($product->toppings)

        
                            <ul>
                               
                                @foreach ($product->toppings as $topping)
                                    <li>
                                        
                                        <input type="checkbox" name="toppings[]" value="{{ $topping->id }}">

                                        {{ $topping->toppingName }}-

                                        £ {{ number_format($topping->price, 2) }}

                                    </li>
                                @endforeach
                            </ul>
                        @endif 


                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="number" name="quantity" value="1">
                            <button type="submit" class="btn btn-primary">
                                Add to cart
                            </button>
                            @endauth
                            @guest
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg mt-4">
                                Login to Buy
                            </a>
                            @endguest
                        </form>
                    </div>
                @endforeach
            @endif

        </div>

        

    </section>



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
