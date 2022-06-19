@extends('layouts.app')

@section('content')
<div class="container">
    <h1> My Cart - #{{$cart->id}}</h1>
</div>
<div class="container">
    <a class="btn btn-primary" href="{{route('home')}}" role="button">Back to Home</a>
</div>
    <div class="container">
        <div class="row">
            @if ($cart->products && $cart-> products->count())
                
           
            <div class="col-sm-12 col-md-10 col-md-offset-1">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Pizza</th>
                            <th>Quantity</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Total</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart->products as $product )
                        <tr>

                            <td class="col-sm-8 col-md-6">
                               


                            <div class="media">
                                <a class="thumbnail pull-left" href="#"> <img class="media-object"
                                     src="{{$product->image}}" style="width: 100px; height: 72px;"> </a>

                                <div class="media-body">
                                    <h4 class="media-heading"><a href="#">{{ $product ->typeofpizza->name }}</a></h4>
                                    <h5 class="media-heading"> Size <a href="#">{{ucfirst( $product->size )}}</a></h5>
                                  @if ($product->pivot->toppings)
                                  Toppings Added:
                                  <ul>
                                    
                                 @foreach (json_decode($product->pivot->toppings) as  $topping)
                                    <li>
                                        {{\App\Models\Topping::find($topping)->toppingName}} - 
                                        £ {{number_format(\App\Models\Topping::find($topping)->price, 2)}}
                                    </li>
                                 @endforeach
                                 
                                  </ul>
                                  @endif
                                  <br>
                               
                                    <span>Status: </span><span class="text-success"><strong>In Stock</strong></span>
                                </div>
                            </div>
                        </td>
                             
                            <td class="col-sm-1 col-md-1 text-center">
                                <strong>
                                    {{$product->pivot->quantity}}
                                           
                                </strong>
                                </td>

                            <td class="col-sm-1 col-md-1 text-center"><strong>£ {{$product->pivot->price}}</strong></td>
                            <td class="col-sm-1 col-md-1 text-center"><strong>£ {{$product->pivot->total}}</strong></td>
                            <td class="col-sm-1 col-md-1">
                                <form action="{{ route('cart.destroy', $cart->id) }}" method="POST"
                                    id="delete-{{ $product->id }}-product" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="product_id" value="{{ $product->id }}"/>
                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                        onclick="confirm('Are you sure you want to delete {{ $product->name }} ?') ? document.getElementById('delete-{{ $product->id }}-product').submit() : null">
                                        <span class="glyphicon glyphicon-remove"></span> Remove
                                    </button>
                                </form>
                           
                        </tr>
                      
                        @endforeach
   
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td>   </td>
                            <td><h3>Total</h3></td>
                            <td class="text-right"><h3><strong>£ {{$cart->total}}</strong></h3></td>
                        </tr>
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td>   </td>
                            <td>
                            <button type="button" class="btn btn-default">
                                <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
                            </button></td>
                            <td colspan="5">
                                <a href="{{ route('cart.checkout',$cart->id) }}" class="btn btn-success">Checkout 
                                       </a>
                           </td>
                        </tr>
                    </tbody>
                    
                </table>
            </div>
            @else
            <h3> There are no pizza's in the cart</h3>
            @endif
        </div>
    </div>
    @endsection