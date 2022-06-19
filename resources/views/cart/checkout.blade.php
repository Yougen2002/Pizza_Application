@extends('layouts.app')

@section('content')

<div class="container">
  
   
    <div class="row">
      <div class="col-md-4 order-md-2 mb-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-muted">Deals</span>

          <span class="badge badge-secondary badge-pill">3</span>
        </h4>
        
        <form method="POST" action="{{route('cart.order.update',[$cart->id, $order->id]) }}" >
          
            @if (session()->has('error'))
              <div class="alert alert-danger">
                {{ session()->get('error') }}
              </div>
              
            @endif
            @if (session()->has('deal_success'))
              <div class="alert alert-success">
                {{ session()->get('deal_success') }}
              </div>
              
            @endif
          @csrf
          <ul class="list-group mb-5 ">
            @foreach ($deals as $deal) 
              
         
            <li class="list-group-item d-flex justify-content-between 1h-condensed {{ $order->deal_id == $deal->id ? 'bg-info':''}}">
              <div>
                <h6 class="my-0 fw-bolder">{{$deal->name}}</h6>
                <small class="fst-italic">{{$deal->description}}</small>
              </div>
    
              <button type="submit" class="btn btn-sm btn-warning "  name="deal_id" value="{{$deal->id}}">Apply</button>
            </li>
            @endforeach
          </ul>
        </form>



        <h4 class="d-flex justify-content-between align-items-center mb-3 mt-4">
          <span class="text-muted">Your cart</span>
          <span class="badge badge-secondary badge-pill">3</span>
        </h4>
       
        <ul class="list-group mb-3">
            @if ($cart->products && $cart->products->count())
        @foreach ($cart->products as $product )
          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0">{{ $product ->typeofpizza->name }}</h6>
              <small class="text-muted">{{ucfirst( $product->size )}}</small>
            </div>
            <span class="text-muted">£ {{$product->pivot->total}}</span>
          </li>
              
          @endforeach
          @endif

          
          @if ($order->discount)
          <li class="list-group-item d-flex justify-content-between">
              <span>Sub Total (GBP)</span>
              <strong>£ {{  $cart->total, }}</strong>
          </li>
          <li class="list-group-item d-flex justify-content-between">
              <span>Discount (BBP)</span>
              <strong>£  {{ $order->discount}}</strong>
          </li>
      @endif

          <li class="list-group-item d-flex justify-content-between">
            <span>Total (GBP)</span>
            <strong>£ {{$order->total}}</strong>
          </li>
    
        </ul>

        <div class="col-6">
          <label for="delivery_method" class="form-label">Delivery Method</label>
          <select class="form-control @error('delivery_method') is-invalid @enderror" id="delivery_method"
          name="delivery_method">
              @foreach (['collection', 'delivery'] as $value)
                  <option value="{{ $value }}" {{ old('status', $order->delivery_method) == $value ? 'selected' : '' }}>{{ $value }}</option>
              @endforeach
          </select>
  </div>

      
      </div>
      <div class="col-md-8 order-md-1">
        <h4 class="mb-3">Customer Information</h4>
        <form class="needs-validation"   method="POST"
        action="{{ route('cart.complete', [$cart->id, $order->id]) }}" >
          @csrf

          
          <div class="row">

            <div class="col-md-6 mb-3">
              <label for="title" class="form-label">Title</label>
              <select id="title" class="form-select  @error('title') is-invalid @enderror" name="title">

                  <option value="">Choose Title</option>
                  @foreach (['mr', 'mrs', 'miss', 'dr', 'prof'] as $title)
                      <option value="{{ $title }}" {{ old('title',$user->title) == $title ? 'selected' : '' }}>
                          {{ ucfirst($title) }}.</option>
                  @endforeach
              </select>
                 <!--Displaying the error message if title is not selected-->
                 @error('title')
                 <div class="invalid-feedback">
                    Please select a title!
                 </div>
                  @enderror
          </div>


            <div class="col-md-6 mb-3">
                <label for="first_name" class="form-label  @error('first_name') is-invalid @enderror">First Name </label>
                <input type="text" class="form-control" id="first_name" placeholder="Enter your First Name"
                    name="first_name" value="{{ old('first_name', $user->first_name) }}">
                     <!--Displaying the error message if first name is not given-->
               @error('first_name')
               <div class="invalid-feedback">
                  Please enter your First Name!
               </div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="last_name" class="form-label @error('last_name') is-invalid @enderror">Last Name</label>
                <input type="text" class="form-control" id="last_name" placeholder="Enter your Last Name" name="last_name"
                    value="{{ old('last_name', $user->last_name) }}">
                     <!--Displaying the error message if Last Name is not given-->
               @error('last_name')
               <div class="invalid-feedback">
                  Please Enter your Last Name!
               </div>
                @enderror
            </div>
          </div>

          <div class="mb-3">
            <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="male" value="male"
                        {{ old('gender',$user->gender) == 'male' ? 'checked' : '' }}>
                    <label class="form-check-label" for="male">
                        Male
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="female" value="female"
                        {{old('gender',$user->gender) == 'female' ? 'checked' : '' }}>
                    <label class="form-check-label" for="female">
                        Female
                    </label>
                    <!--Check whether the gender field is selected-->
                    @error('gender')
                    <div class="invalid-feedback">
                      Select Your Gender!!!
                    </div>
                     @enderror
                </div>
               
            </div>
          </div>

          <div class="mb-3">
            <label for="date_of_birth" class="form-label @error('date_of_birth') is-invalid @enderror">Date Of Birth</label>
                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth) }}">
               <!--Check whether the date of birth is selected-->
               @error('date_of_birth')
               <div class="invalid-feedback">
                 Select Your Date Of Birth
               </div>
                @enderror
          </div>

          <div class="mb-3">
            <h4 class="fw-bolder">Address</h4>
            <div class="col-12">
                <label for="address_1" class="form-label">Address 1</label>
                <input type="text" class="form-control @error('address_1') is-invalid @enderror" id="address_1" placeholder="Address 1" name="address_1"
                    value="{{ old('address_1', $user->address_1) }}">
                    <!--Check whether the Address 1 is entered-->
             @error('address_1')
             <div class="invalid-feedback">
               Please enter your Address 1
             </div>
              @enderror
          </div>

          <div class="mb-3">
            <label for="address_2" class="form-label">Address 2</label>
                    <input type="text" class="form-control @error('address_2') is-invalid @enderror" id="address_2" placeholder="Address 2" name="address_2"
                        value="{{ old('address_2', $user->address_2) }}">
                        <!--Check whether the address 2 is entered-->
                 @error('address_2')
                 <div class="invalid-feedback">
                    Please enter your Address 2
                 </div>
                  @enderror
          </div>

          <div class="row">
            <div class="col-md-5 mb-3">
                <div class="col-md-6">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" placeholder="Enter the city" name="city"
                        value="{{ old('city', $user->city) }}">
                              <!--Check whether the city is entered-->
             @error('city')
             <div class="invalid-feedback">
                Please enter your City
             </div>
              @enderror
            </div>
            <div class="col-md-5 mb-3">
                <label for="postcode" class="form-label">Post Code</label>
                <input type="text" class="form-control @error('postcode') is-invalid @enderror" id="postcode" placeholder="Postal Code" name="postcode"
                    value="{{ old('postcode', $user->postcode) }}">
                          <!--Check whether the post code is entered-->
         @error('postcode')
         <div class="invalid-feedback">
            Please enter your Post Code
         </div>
          @enderror
            </div>
            <div class="row">
                <h4 class="fw-bolder">Contact Details</h4>
                <div class="row">
                    <div class="col-10">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="Enter Phone Number" name="phone"
                            value="{{ old('phone', $user->phone) }}">
                                  <!--Check whether the phone number is entered-->
                 @error('phone')
                 <div class="invalid-feedback">
                    Please enter your Phone Number
                 </div>
                  @enderror
          </div>
        
          <div class="row">
            <label for="mobile" class="form-label">Mobile</label>
                        <input type="text" class="form-control @error('mobile') is-invalid @enderror" id="mobile" placeholder="Enter Mobile Number"
                            name="mobile" value="{{ old('mobile', $user->mobile) }}">
                    <!--Check whether the mobile number is entered-->
                 @error('mobile')
                 <div class="invalid-feedback">
                    Please enter Mobile Number
                 </div>
                  @enderror
      </div>
<div class="p-3">
          <h4 class="mb-3 ">Payment</h4>

          <div class="d-block my-1">
            <div class="custom-control custom-radio">
              <input id="credit" type="radio" class="custom-control-input" checked required>
              <label class="custom-control-label" for="credit">Credit card</label>
            </div>
          </div>
</div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="cc-name">Name on card</label>
              <input type="text" class="form-control" id="cc-name" placeholder="" >
              <small class="text-muted">Full name as displayed on card</small>
              <div class="invalid-feedback">
                Name on card is required
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="cc-number">Credit card number</label>
              <input type="text" class="form-control" id="cc-number" placeholder="">
              <div class="invalid-feedback">
                Credit card number is required
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3 mb-3">
              <label for="cc-expiration">Expiration</label>
              <input type="text" class="form-control" id="cc-expiration" placeholder="">
              <div class="invalid-feedback">
                Expiration date required
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="cc-expiration">CVV</label>
              <input type="text" class="form-control" id="cc-cvv" placeholder="" >
              <div class="invalid-feedback">
                Security code required
              </div>
            </div>
          </div>
          <hr class="mb-4">
          <button class="btn btn-primary btn-lg btn-block" type="submit">Complete Order</button>
        </form>
      </div>
    </div>

    <footer class="my-5 pt-5 text-muted text-center text-small">
      <p class="mb-1">&copy; 2017-2018 Company Name</p>
      <ul class="list-inline">
        <li class="list-inline-item"><a href="#">Privacy</a></li>
        <li class="list-inline-item"><a href="#">Terms</a></li>
        <li class="list-inline-item"><a href="#">Support</a></li>
      </ul>
    </footer>
  </div>
    @endsection