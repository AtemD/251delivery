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
                                    {{$product->base_price}}
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

@empty 
    <div class="alert alert-info" role="alert">
        No products to show for this section
    </div>
@endforelse