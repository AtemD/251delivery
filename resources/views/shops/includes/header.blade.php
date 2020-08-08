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