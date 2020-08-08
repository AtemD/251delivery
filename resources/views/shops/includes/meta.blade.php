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
            <div class="shop-item-cuisine-list">
                @forelse($shop->cuisines as $cuisine)
                    <span class="badge badge-info text-white">{{$cuisine->name}}</span>
                @empty
                    <div class="alert alert-info" role="alert">
                        No cuisines chosen by this shop
                    </div>
                @endforelse
            </div>
        </div>
        <br>
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