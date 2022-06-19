@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="p-5 mb-4 bg-light rounded-3">
            <h1>Contact Us Page</h1>

            <div>
                <p class="fw-bold"> Email: pizzaBreeze@gmail.com </p>
                <p class="fw-bold"> Mobile Number: 0723456778 </p>
                <p class="fw-bold"> Address: 123, ABC Street, XYZ Town, ZXC Country </p>
                <p class="fw-bold"> Opening Hours: Mon-Fri: 9am-5pm </p>
                <p class="fw-bold"> Telephone: +44 (0) 20 3456 7890</p>
        </div>
    </div>
    
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