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
                                <div class="alert alert-danger" role="alert">
                                    @foreach($errors->all() as $error)
                                        <li class="text-danger">* {{$error}}</li>
                                    @endforeach
                                </div>
                               
                                <!--CITY SHOULD BE STORED IN SESSION BECAUSE AS THE USER REACHES HERE, HE/SHE HAS ALREADY CHOSEN A LOCATION -->
                                <label for="city">City</label>
                                <select name="city" class="form-control @error('city') is-invalid @enderror" id="city"
                                    required>
                                    @forelse($cities as $city)
                                        <option value="{{$city->id}}" {{ $city->name == session()->get('city_name') ? 'selected': ''}}>
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
                                <label for="order_type">Order Type</label>
                                <select name="order_type" class="form-control @error('order_type') is-invalid @enderror" id="order_type"
                                    required>
                                    @forelse($order_types as $order_type)
                                        <option value="{{$order_type->id}}"
                                            @if(session()->has('order_type_name'))
                                                {{ session()->get('order_type_name') == $order_type->name ? 'selected' : ''}}    
                                            @endif>
                                            {{ $order_type->name }}
                                        </option>
                                    @empty 
                                        <div class="alert alert-warning" role="alert">
                                            No cities cities to show, contact admin for help!
                                        </div>
                                    @endforelse
                                </select>
    
                                @error('order_type')
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
    
                            {{-- <div class="form-group">
                                <label for="address">Delivery Address/Location</label>
                                <textarea type="text" rows="3" name="address" id="address" class="form-control @error('address') is-invalid @enderror" 
                                value="{{ old('address') }}" placeholder="Your Address" required></textarea>
    
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> --}}

                            <div class="form-group">
                                <label for="delivery_address">Delivery Address/Location</label>
                                    @forelse($user_delivery_addresses as $delivery_address)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="delivery_address" id="delivery-address-{{$loop->index}}" value="{{$delivery_address}}">
                                            <label class="form-check-label" for="delivery-address-{{$loop->index}}">
                                              {{$delivery_address}}
                                            </label>
                                        </div>
                                    @empty 
                                        <div class="form-group">
                                            <label for="new_delivery_address">Delivery Address/Location</label>
                                            <textarea type="text" rows="3" name="new_delivery_address" id="new_delivery_address" class="form-control @error('new_delivery_address') is-invalid @enderror" 
                                            value="{{ old('new_delivery_address') }}" placeholder="Your Delivery Address" required></textarea>
                
                                            @error('new_delivery_address')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->new_delivery_address }}</strong>
                                                </span>
                                            @enderror
                                        </div> 
                                    @endforelse
    
                                @error('delivery_address')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $errors->delivery_address }}</strong>
                                    </span>
                                @enderror
                            </div>
    
                            <div class="form-group">
                                <label for="payment_method">Preferred Payment Method</label>
                                    @forelse($payment_methods as $payment_method)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="payment_method" id="payment-method-{{$payment_method->id}}" value="{{$payment_method->id}}">
                                            <label class="form-check-label" for="payment-method-{{$payment_method->id}}">
                                              {{$payment_method->name}}
                                            </label>
                                        </div>
                                    @empty 
                                        <div class="alert alert-warning" role="alert">
                                            No Payment Methods to show, contact admin for help!
                                        </div>
                                    @endforelse
    
                                @error('payment_method')
                                    <span class="text-danger" role="alert">
                                        <strong>*** {{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <hr>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" name="agreed_to_terms_and_conditions" id="agreed_to_terms_and_conditions" {{ old('agreed_to_terms_and_conditions') ? 'checked' : '' }} required>
                                <label class="form-check-label" for="agreed_to_terms_and_conditions">
                                    I have read and agreed with this websites terms and conditions
                                </label>
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
                                x{{$product->quantity}}
                            </div>
                            <div class="col-md-3">
                                {{$product->base_price*$product->quantity}} ETB
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
