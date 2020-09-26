@extends('dashboard.retailer.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    Account Status 
                    <span class="badge badge-{{$shop->shopAccountStatus->color}}">
                        {{$shop->shopAccountStatus->name}}
                    </span>
                </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('retailer.shops.index', ['shop' => $shop])}}">Home</a></li>
                <li class="breadcrumb-item">Settings</li>
                <li class="breadcrumb-item"><a href="{{route('retailer.shops.accounts.index', ['shop' => $shop])}}">Account</a></li>
                <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Shop Details</h3>
  
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                </div>
              </div>
              <!-- form start -->
              <form role="form" method="POST" action="{{ route('retailer.shops.accounts.update', ['shop' => $shop]) }}">
                @method('PUT')
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $shop->name }}" id="name" 
                            placeholder="Your shops name" required>
                        
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $shop->email }}" id="email" 
                            placeholder="Your shops email" required>
                        
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ $shop->phone_number }}" id="phone_number" 
                            placeholder="Your shops phone_number" required>
                        
                        @error('phone_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <h6><b>Average Food Preparation Time</b></h6>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="min_food_preparation_time">Min <small class="text-muted">(in minutes)</small></label>
                            <input type="text" name="min_food_preparation_time" class="form-control @error('min_food_preparation_time') is-invalid @enderror" value="{{ $shop->min_food_preparation_time }}" id="min_food_preparation_time" 
                                placeholder="e.g 15" required>

                            @error('min_food_preparation_time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="max_food_preparation_time">Max <small class="text-muted">(in minutes)</small></label>
                            <input type="text" name="max_food_preparation_time" class="form-control @error('max_food_preparation_time') is-invalid @enderror" value="{{ $shop->max_food_preparation_time }}" id="max_food_preparation_time" 
                                placeholder="e.g 60" required>

                            @error('max_food_preparation_time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="shop_type">Shop Type</label>
                        <select name="shop_type" class="form-control @error('shop_type') is-invalid @enderror" id="shop_type"
                            required>
                            @forelse($shop_types as $shop_type)
                                <option value="{{$shop_type->id}}" {{ $shop->shopType->id == $shop_type->id ? 'selected' : '' }}>
                                    {{ $shop_type->name }}
                                </option>
                            @empty 
                                <div class="alert alert-warning" role="alert">
                                    No shop types to show, contact admin for help!
                                </div>
                            @endforelse
                        </select>

                        @error('shop_type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea type="text" rows="6" name="description" id="description" class="form-control @error('rate') is-invalid @enderror" 
                        required>{{$shop->description}}</textarea>

                        @error('description')
                            <span class="text-danger" role="alert">
                                <strong>*{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    @foreach ($errors->all() as $error)
                                    {{$error}}<br>
                                    @endforeach

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update Details</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Avalilability Status</h3>
  
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                </div>
              </div>
              <form role="form" method="POST" action="{{ route('retailer.shops.availability.update', ['shop' => $shop]) }}">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Availability Status</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="availability_status" name="availability_status" 
                                {{$shop->is_available === 1 ? 'checked' : ''}}>
                            <label class="custom-control-label" for="availability_status"><small class="text-muted">(available/unavailable)</small></label>
                        </div>

                        @error('availability_status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update Availability Status</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Edit Shop Banner Image</h3>
    
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                      <i class="fas fa-minus"></i></button>
                  </div>
                </div>
                <form role="form" method="POST" action="{{ route('retailer.shops.images.update', ['shop' => $shop]) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="image">Choose Image Update <small>(This is the image that appears when users search for you)</small></label>
                                <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image">

                                @error('image')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <img class="img-fluid mb-3 img-thumbnail" style="height: 120px; width:150px;" src="{{$shop->bannerImagePath}}" alt="Photo">
                            </div>
                            
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update Banner Image</button>
                    </div>
                </form>
              </div>
              <!-- /.card -->
          </div>
        </div>
        
      </section>
@endsection 