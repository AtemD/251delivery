@extends('layouts.app')

@section('title', '| Show')

@section('content')
<div class="container">
    <div class="shop-item-details">
        <header class="shop-item-header">
            <div class="row pt-4">
                <div class="col-md-6">
                    <h2>{{$shop->name}}</h2>
                    <p>
                        <i class="fas fa-map-marker"></i> 
                        {{$shop->location->address}}
                    </p>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <h2><span class="badge shop-item-header-shop-type">{{$shop->shopType->name}}</span></h2>
                </div>
            </div>
        </header>

        <div class="row">
            <div class="col-md-7">
                <div class="shop-item-tab">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-photo-tab" data-toggle="tab" href="#nav-photo" role="tab" aria-controls="nav-photo" aria-selected="true">
                                Photo
                            </a>
                            <a class="nav-item nav-link" id="nav-map-tab" data-toggle="tab" href="#nav-map" role="tab" aria-controls="nav-map" aria-selected="false">
                                On The Map
                            </a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-photo" role="tabpanel" aria-labelledby="nav-photo-tab">
                            <img src="{{$shop->banner_image_path}}" height="490" width="653" alt="..." class="img-fluid">
                        </div>
                        <div class="tab-pane fade" id="nav-map" role="tabpanel" aria-labelledby="nav-map-tab">
                            ...Google maps here.
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="shop-item-meta">
                    <div class="shop-item-rating pt-4 mt-2">
                        <ul class="list-group list-group-horizontal shop-item-rating-stars">
                            <li><i class="fa fa-star"></i>
                            </li>
                            <li><i class="fa fa-star"></i>
                            </li>
                            <li><i class="fa fa-star"></i>
                            </li>
                            <li><i class="fa fa-star"></i>
                            </li>
                            <li><i class="fa fa-star"></i>
                            </li>
                        </ul>
                        <span class="shop-item-rating-number">(<b>4.7</b> / 5)</span>
                        <p><a class="text-default" href="#">based on (535)reviews</a></p>
                    </div>
                    <div class="shop-item-meta-data">
                        <div class="shop-item-cuisine">
                            <ul class="list-group list-group-horizontal shop-item-cuisine-list">
                                @forelse($shop->cuisines as $cuisine)
                                    <li><span class="badge badge-info text-white">{{$cuisine->name}}</span></li>
                                @empty
                                    <div class="alert alert-info" role="alert">
                                        No cuisines chosen by this shop
                                    </div>
                                @endforelse
                            </ul>
                        </div>
                        
                        <div class="shop-item-preparation-time">
                            <h4><span class="badge badge-secondary">{{$shop->average_preparation_time}} min</span></h4>
                        </div>
                        
                        <hr>

                        <div class="shop-item-about-us">
                            <h5>About Us</h5>
                            <p>{!! mb_substr($shop->description, 0,400) !!}</p>
                            <a href="#menu" class="btn btn-outline-primary btn-lg btn-block">
                                Order Food Now <span class="badge"> <i class="fas fa-angle-double-down"></i></span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <hr>

        <p id="menu"></p>

        <div class="row">
            <div class="col-md-12">
                @forelse($shop->sections as $section)
                    <div class="shop-item-section" id="{{$section->name}}">
                        <h3 class="mt-4 mb-2">{{$section->name}}</h3>
                        <div class="row">

                            @forelse($section->products as $product)
                                <div class="col-md-6 col-sm-12 col-12">
                                    <a type="button" data-toggle="modal" data-target="#product-{{$product->id}}">
                                        <div class="shop-item-product">
                                            <div class="card mb-3">
                                                <div class="row no-gutters">
                                                    <div class="col-3 p-1">
                                                        <img class="card-img img-fluid" src="{{$product->image_path}}" alt="product image">
                                                    </div>
                                                    <div class="col-7">
                                                        <div class="card-body shop-item-product-details">
                                                            <h5 class="card-title shop-item-product-title">{{$product->name}}</h5>
                                                            <small><p class="card-text text-muted text-break">{!! mb_substr($product->description, 0,40) !!}</p></small>
                                                            @if($product->status == 'unavailable')
                                                            <p class="shop-item-product-status">
                                                                <span class="badge badge-secondary">Unavailable</span><br>
                                                                <small class="text-muted shop-item-product-status-reason">out of stock</small>
                                                            </p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-2 pt-2">
                                                        <div  class="shop-item-product-price">
                                                            <p class="card-text text-muted d-flex justify-content-center">
                                                                {{$product->price}}
                                                            </p>
                                                            <p class="card-text text-muted d-flex justify-content-center shop-item-product-currency">ETB</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <!-- /.col -->

                                <!-- Modal -->
                                <div class="modal fade" id="product-{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="productLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">{{$product->name}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                ...
                                            </div>
                                            <div class="modal-footer">
                                                <div class="container pl-1 pr-1">
                                                    <div class="row no-gutters">
                                                        <div class="col-5 justify-content-start">
                                                            <td class="d-flex justify-content-between">
                                                                <button type="button" class="btn btn-outline-danger btn-sm">-</button>
                                                                    <strong class="mx-1"> 1 </strong> 
                                                                <button type="button" class="btn btn-outline-success btn-sm">+</button>
                                                            </td>
                                                        </div>
                                                        <div class="col-7">
                                                            <button type="button" class="btn btn-primary btn-block">Add for ETB 500</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @empty 
                                <div class="alert alert-info" role="alert">
                                    No products to show for this section
                                </div>
                            @endforelse

                        </div>
                    </div>
                @empty
                    <div class="alert alert-info" role="alert">
                        No foood sections to show for this shop
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    



    <div class="container">
        <div class="row">
            <div class="modal fade" id="ShopCartDetail" tabindex="-1" role="dialog" aria-labelledby="cartDetailLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cartDetailLabel">Cart Contents</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Dinish</th>
                                            <td>30 ETB</td>
                                            <td class="d-flex justify-content-end">
                                                <button @click="removeFromCart(cartItem)" type="button" class="btn btn-danger btn-sm">-</button>
                                                    <strong class="mx-1"> 6 </strong> 
                                                <button @click="addToCart(cartItem)" type="button" class="btn btn-success btn-sm">+</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Proceed to CheckOut</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
