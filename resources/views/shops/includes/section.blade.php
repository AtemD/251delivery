@forelse($shop->sections as $section)
    <div class="shop-item-section" id="{{$section->name}}">
        <h3 class="mt-4 mb-2">{{$section->name}}</h3>
        <div class="row">

            @forelse($section->products as $product)

                <product-component :cart="cart" :product="{{$product}}">
                </product-component>

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