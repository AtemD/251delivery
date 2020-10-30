@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-primary card-outline mt-5">
                    <div class="card-header">
                        <h3 class="card-title">Checkout Information</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{ route('place_order.store') }}">
                        @csrf 
    
                        <div class="card-body">
    
                            <div class="form-group">
                                <!--CITY SHOULD BE STORED IN SESSION BECAUSE AS THE USER REACHES HERE, HE/SHE HAS ALREADY CHOSEN A LOCATION -->
                                <label for="city">City</label>
                                <select name="city" class="form-control @error('city') is-invalid @enderror" id="city"
                                    required>
                                    @forelse($cities as $city)
                                        <option value="{{$city->id}}">
                                            {{ $city->name }}
                                        </option>
                                    @empty 
                                        <div class="alert alert-warning" role="alert">
                                            No cities cities to show, contact admin for help!
                                        </div>
                                    @endforelse
                                </select>
    
                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
    
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ (old('phone_number')) ? old('phone_number') : Auth()->user()->phone_number }}" required autocomplete="phone_number" autofocus>
    
                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
    
                            <div class="form-group">
                                <label for="address">Delivery Address/Location</label>
                                <textarea type="text" rows="3" name="address" id="address" class="form-control @error('address') is-invalid @enderror" 
                                value="{{ old('address') }}" placeholder="Your Address" required></textarea>
    
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
    
                            <div class="form-group">
                                <label for="payment_methods">Preferred Payment Method</label>
                                    @forelse($payment_methods as $payment_method)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="payment_methods" id="payment-method-{{$payment_method->id}}" value="{{$payment_method->id}}">
                                            <label class="form-check-label" for="payment-method-{{$payment_method->id}}">
                                              {{$payment_method->name}}
                                            </label>
                                        </div>
                                    @empty 
                                        <div class="alert alert-warning" role="alert">
                                            No Payment Methods to show, contact admin for help!
                                        </div>
                                    @endforelse
    
                                @error('payment_methods')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <hr>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" name="agreed_to_terms_and_conditions" id="agreed_to_terms_and_conditions" required>
                                <label class="form-check-label" for="agreed_to_terms_and_conditions">I have read and agreed with this websites terms and conditions</label>
                            </div>
    
                        </div>
                        <!-- /.card-body -->
                
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block">Place Order</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-6">
                <div class="card card-primary card-outline mt-5">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">Your Cart Summary</h5>
                            <a href="{{$cart['shop']->path()}}" class="card-link text-primary">Edit</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach($cart['products'] as $product)
                        <div class="row">
                            <div class="col-md-6">
                                {{ $product->name}}
                            </div>
                            <div class="col-md-3">
                                x{{$product->ordered_qty}}
                            </div>
                            <div class="col-md-3">
                                {{$product->base_price*$product->ordered_qty}} ETB
                            </div>
                        </div>
                        @endforeach

                        <hr>
                        <div class="cart-summary d-flex justify-content-center">
                            <h5>Grand Total: {{ $cart['grand_total'] }}</h5>
                            <small>( {{ $cart['total_items'] }} items)</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
@endsection
