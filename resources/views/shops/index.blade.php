@extends('layouts.app')

@section('title', '| Welcome')

@section('content')
<div class="container py-4">
	<div class="row pb-4">
		<div class="col-md-12">
			<nav class="navbar navbar-light shadow border border-success">

				<h5><span class="badge badge-secondary mr-1">{{ session()->get('city_name') }}</span></h5>
				<h5><span class="badge badge-secondary mr-1"> {{ session()->get('order_type_name') }}</span></h5>

				<!-- search and filters-->
				<ul class="navbar-nav mr-auto"></ul>
				<button class="btn btn-sm btn-outline-secondary mr-4">
					<i class="fas fa-filter"></i> Filters
				</button>
				
				
				<form class="form-inline my-2 my-lg-0">
					<input class="form-control mr-sm-2" type="search" placeholder="Search restaurants, meals..." aria-label="Search">
					<button class="btn btn-sm btn-outline-success my-2 my-sm-0" type="submit">Search</button>
				</form>

			</nav>
			{{-- 
			<div class="alert alert-success border-success" role="alert">
				<div class="row justify-content-between">
					<div class="col-md-6">
						<h5><span class="badge badge-secondary">{{ session()->get('city_name') }}</span></h5>
						<h5><span class="badge badge-secondary">{{ session()->get('order_type_name') }}</span></h5>
					</div>
					<div class="col-md-6">
						<!-- search and filters-->
					</div>
				</div>
			</div> 
			--}}
		</div>
	</div>
	<div class="row shop-list py-4">
		@forelse($shops as $shop)
			<div class="col-md-4 pb-4">
				<div class="shop-item">
					<a href="{{$shop->path()}}">
						<div class="card mb-3">
							<img src="{{$shop->banner_image_path}}" height="180" width="40" class="card-img-top" alt="...">
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