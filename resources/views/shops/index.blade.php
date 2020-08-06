@extends('layouts.app')

@section('title', '| Welcome')

@section('content')
<div class="container py-4">
	<div class="row shop-list py-4">
		@forelse($shops as $shop)
			<div class="col-md-4 pb-4">
				<div class="shop-item">
					<a href="{{$shop->path()}}">
						<div class="card mb-3">
							<img src="/uploads/shops/banner_images/{{$shop->banner_image}}" height="180" width="40" class="card-img-top" alt="...">
							<div class="card-body">
								<h5 class="card-title shop-item-title">
									{!! mb_substr($shop->name, 0,35) !!}
								</h5>
	
								<p class="card-text shop-item-cuisine-list">
									<small>
										@forelse($shop->cuisines as $cuisine)
											<span class="badge badge-info text-white shop-item-cuisine-item">
                                                {{$cuisine->name}}
                                            </span>
										@empty 
											No cuisines
										@endforelse
									</small>
								</p>
								<h5>
                                    <span class="badge shop-item-average-preparation-time">
                                        {{$shop->average_preparation_time}}
                                    </span>
                                    <span class="badge shop-item-rating-number">
                                        4.5<i class="fa fa-star"></i>(400+)
                                    </span>
                                    <span class="badge shop-item-shop-type">
                                        {{$shop->shopType->name}}
                                    </span>
								</h5>
							</div>
						</div>
					</a>
				</div>
			</div>
		@empty 
			<p>No shops to show</p>
		@endforelse
	</div>

	<div class="row">
		<div class="col-md-12">
			{{ $shops->links()}}
		</div>
	</div>
</div>
@endsection