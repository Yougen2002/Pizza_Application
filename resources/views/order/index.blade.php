@extends('layouts.app')

@section('content')
    <div class="container p-3">
        <h3 class="fs-4 fw-bold "> Orders placed by Users </h3>
    </div>
    <div class="container">
        <table class="table table-hover table-bordered table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">User</th>
                   
                    <th scope="col">deal</th>
                    <th scope="col">status</th>
                    <th scope="col">payment status</th>
                    <th scope="col">Delivery Method</th>
            
                    <th scope="col">Discount</th>
                    <th scope="col">Total</th>
                    <th scope="col">Products Purchased</th>
                    <th scope="col">Update</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <th scope="row">{{ $order->id}}</th>
                        <td>{{ $order->user->name}}</td>
                        <td>{{ $order->deal ? $order->deal->name: '_'}}</td>
                       
                        <td>{{ucfirst( $order->status) }}</td>
                        <td>{{ ucfirst($order->payment_status) }}</td>
                        <td>{{ ucfirst($order->delivery_method) }}</td>
                        <td>{{ucfirst( $order->discount) }}</td>
                        <td>£ {{ ucfirst($order->total) }}</td>
                  
                   
                    <td>
                        <ul>
                    @foreach ($order->cart->products as $product)
                        <li> {{$product->typeofpizza->name}} <br>
                           Quantity: {{$product->pivot->quantity}} <br>
                            Item Price: £{{$product->pivot->total}}
                        </li>
                        
                    @endforeach
                </ul>
                    </td>

                    <td>
                        <a href="{{route('orders.edit',$order->id)}}" class="btn btn-primary btn-sm">Edit</a>
                       </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $orders->links() }}
        
    @endsection
