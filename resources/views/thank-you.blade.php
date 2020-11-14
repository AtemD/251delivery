@extends('layouts.app')

@section('title', '| Thank You')

@section('content')
    <div class="container">
        <div class="row">
            @if(isset($users_latest_order_today))
            <div class="col-md-12">
                <h1>Thank you for your order!</h1>
                <p>Order Number: <span class="text-primary">{{$users_latest_order_today->number}}</span></p>
                <p><a href="/" class="btn btn-primary alert-link"><< Back To Shopping</a></p>
                <hr>

                <div class="card card-primary card-outline mt-5">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">Cart Summary</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach($users_latest_order_today->products as $product)
                        <div class="row">
                            <div class="col-md-6">
                                {{ $product->name}}
                            </div>
                            <div class="col-md-3">
                                x{{$product->pivot->quantity}}
                            </div>
                            <div class="col-md-3">
                                {{$product->pivot->amount}} ETB
                            </div>
                        </div>
                        @endforeach

                        <hr>
                        <div class="cart-summary d-flex justify-content-center">
                            <h5>Grand Total: 300ETB</h5>
                            <small>( 4 items )</small>
                        </div>
                    </div>
                </div>
            </div>
            @else 
            <div class="col-md-12 mt-4">
                <div class="alert alert-warning" role="alert">
                    Sorry, it seems like you did not place any order today<br>
                     <a href="#" class="alert-link">(click here to place new order)</a>
                </div>
            </div>
            @endif
        </div>
    </div>
    
@endsection

