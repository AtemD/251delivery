@extends('layouts.app')

@section('title', '| Show')

@section('content')
<div class="container">
    <div class="shop-item-details">
        @include('shops.includes.header')

        
        <div class="row">
            <div class="col-md-7">
                @include('shops.includes.tab')
            </div>
            <div class="col-md-5">
                @include('shops.includes.meta')
            </div>
        </div>

        <hr>

        <p id="menu"></p>

        <div class="row">
            <div class="col-md-12">
                @include('shops.includes.section')
            </div>
        </div>

        

        <div class="row">
            <div class="col-md-12">
                @include('shops.includes.cart-details')
            </div>
        </div>
    </div>
</div>
@endsection

@section('cart-nav')
    @include('shops.includes.cart-nav')
@endsection
@section('cart-bottom')
    @include('shops.includes.cart-bottom')
@endsection
