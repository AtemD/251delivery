@forelse($shop->sections as $section)
    <div class="shop-item-section" id="{{$section->name}}">
        <h3 class="mt-4 mb-2">{{$section->name}}</h3>
        <div class="row">
            @include('shops.includes.product')
        </div>
    </div>
@empty
    <div class="alert alert-info" role="alert">
        No foood sections to show for this shop
    </div>
@endforelse