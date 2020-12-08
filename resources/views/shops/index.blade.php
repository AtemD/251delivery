@extends('layouts.app')

@section('title', '| Welcome')

@section('content')
<div class="container py-4">
	<div class="row pb-4">
		<div class="col-md-12">
			<nav class="navbar navbar-light shadow border border-success">
				<button class="btn btn-sm btn-outline-secondary mr-4" type="button" data-toggle="modal" data-target="#exampleModalCenter">
					<i class="fas fa-filter"></i> Filters
				</button>
{{-- 
				<h5><span class="badge badge-secondary mr-1">{{ session()->get('city') }}</span></h5>
				<h5><span class="badge badge-secondary mr-1"> {{ session()->get('order_type_id') }}</span></h5> --}}

				<!-- search and filters-->
				<ul class="navbar-nav mr-auto"></ul>

				<!-- Modal -->
				<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<!-- form start -->
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalCenterTitle">Select Filters</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								
								<form class="form-group" method="GET" action="{{ route('shops.index') }}">
									<div class="modal-body">
										
										<div class="row">
											<div class="col-md-12">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
															<label class="sr-only" for="city">Select your city</label>
															<select class="custom-select form-control mb-2 mr-sm-2" id="city" name="city" required>
																<option value="" selected>Select your city...</option>
																@forelse($cities as $city)
																	<option value="{{$city->id}}" 
																		@if(session()->has('city'))
																			{{ session()->get('city') == $city->id ? 'selected' : ''}}    
																		@endif>
																		{{$city->name}}
																	</option>
																@empty
																	<p>No cities yet</p>
																@endforelse
															</select>
								
															@if ($errors->has('city'))
																<span class="help-block">
																	<strong>{{ $errors->first('city') }}</strong>
																</span>
															@endif
														</div>
													</div> 
						
													<div class="col-md-6">
														<div class="form-group{{ $errors->has('order_type') ? ' has-error' : '' }}">
															<label class="sr-only" for="order_type">Select your order type</label>
															<select class="custom-select form-control mb-2 mr-sm-2" id="order_type" name="order_type" required>
																<option value="" selected>Select order type...</option>
																@forelse($order_types as $order_type)
																	<option value="{{$order_type->id}}"
																		@if(session()->has('order_type'))
																			{{ session()->get('order_type') == $order_type->id ? 'selected' : ''}}    
																		@endif
																		>
																		{{$order_type->name}}
																	</option>
																@empty
																	<p>No order types yet</p>
																@endforelse
															</select>
								
															@if ($errors->has('order_type'))
																<span class="help-block">
																	<strong>{{ $errors->first('order_type') }}</strong>
																</span>
															@endif
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label for="cuisines">Cuisines:</label>
													<div class="row">

														@php 
															$request_cuisines = collect(request()->input('cuisines'));
														@endphp

														@forelse($cuisines as $cuisine)
															<div class="col-md-4">
																<div class="form-group form-check">
																	<input type="checkbox" name="cuisines[]" value="{{$cuisine->id}}" class="form-check-input" id="add-cuisine-{{$cuisine->id}}" 
																		{{-- {{ collect(session()->get('cuisines'))->contains($cuisine->id) ? 'checked' : '' }} --}}
																		{{ $request_cuisines->contains($cuisine->id) ? 'checked' : '' }}>
																	<label class="form-check-label" for="add-cuisine-{{$cuisine->id}}">
																		{{$cuisine->name}}
																	</label>
																</div>
															</div>
														@empty 
															<p>No cuisines to show</p>
														@endforelse
													</div>
												</div>
											</div>
											<div class="col-md-12">

											</div>
										</div>
									</div>
									<div class="modal-footer justify-content-between">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Search</button>
									</div>
								</form>
							</div>
						</form>
					</div>
				</div>
				
				<form class="form-inline my-2 my-lg-0" method="GET" action="{{ route('shops.index') }}">
					<input type="hidden" name="city" value="{{ session()->has('city') ? session()->get('city') : ''}}">
					<input type="hidden" name="order_type" value="{{ session()->has('order_type') ? session()->get('order_type') : ''}}">

					{{-- @forelse(collect(request()->input('cuisines')) as $req_cuisines)
						<input type="hidden" type="checkbox" name="cuisines[]" value="{{$req_cuisines}}" class="form-check-input" id="add-req-cuisine-{{$req_cuisines}}" 
						checked>
					@empty 

					@endforelse --}}

					<input class="form-control mr-sm-2" type="search" value="{{request()->input('global_shop_search')}}" name="global_shop_search" placeholder="Search restaurants, meals..." aria-label="Search" required>
					<button class="btn btn-sm btn-outline-success my-2 my-sm-0" type="submit">Search</button>
				</form>

			</nav>
		</div>
	</div>

	@if(!empty($request_cuisines))
		<div class="row">
			<div class="col-md-12">
				@forelse( $cuisines as $cuisine)
					@if( $request_cuisines->contains($cuisine->id))
						<span class="badge badge-secondary mr-1 mt-1">{{$cuisine->name}}</span>
					@endif
				@empty 

				@endforelse
			</div>
		</div>
	@endif

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
			<div class="col-md-12">
				<div class="alert alert-info alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h5><i class="icon fas fa-info"></i> No Shops To Show!</h5>
					Try adjusting filters to get desired results.
				</div>
			</div>
		@endforelse
	</div>

	<div class="row">
		<div class="col-md-12">
			{{ $shops->appends(request()->input())->links()}}
		</div>
	</div>
</div>
@endsection