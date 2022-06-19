@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <table class="table bg-white table-striped">
                    <thead>
                        <h2>Edit Order</h2>
                    </thead>
                    <tbody>
                    @if(auth()->user()->role == 'admin')
                    <form class="row g-3" method="POST" action="{{ route('orders.update', $orders->id) }}"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        
                        
                        <div class="row pt-3">
                            <div class="col-6">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" id="status"
                                name="status">
                                    @foreach (['pending', 'processing', 'delivered', 'cancelled'] as $value)
                                        <option value="{{ $value }}" {{ old('status', $orders->status) == $value ? 'selected' : '' }}>{{ucfirst($value)  }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-6">
                                <label for="payment_status" class="form-label">Payment Status</label>
                                <select class="form-control @error('payment_status') is-invalid @enderror" id="payment_status"
                                name="payment_status">
                                    @foreach (['pending', 'paid', 'failed'] as $value)
                                        <option value="{{ $value }}" {{ old('status', $orders->payment_status) == $value ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                        </div>

                        <div class="col-6">
                            <label for="delivery_method" class="form-label">Delivery Method</label>
                            <select class="form-control @error('delivery_method') is-invalid @enderror" id="delivery_method"
                            name="delivery_method">
                                @foreach (['collection', 'delivery'] as $value)
                                    <option value="{{ $value }}" {{ old('status', $orders->delivery_method) == $value ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                    </div>
                        <div class="col-12">
                            <br>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                       
                        </form>
                        @endif
                       
                    </tbody>
                </table>
               
            </div>
        </div>
    </div>
@endsection