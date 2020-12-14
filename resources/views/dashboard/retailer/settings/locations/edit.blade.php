@extends('dashboard.retailer.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Location</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('retailer.shops.index', ['shop' => $shop])}}">Home</a></li>
                <li class="breadcrumb-item">Settings</li>
                <li class="breadcrumb-item"><a href="{{route('retailer.locations.index', ['shop' => $shop])}}">Location</a></li>
                <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- form start -->
                    <form role="form" method="POST" action="{{ route('retailer.locations.update', ['shop' => $shop]) }}">
                        @method('PUT')
                        @csrf 
                        <!-- general form elements -->
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Update Location</h3>
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <select name="city" class="form-control @error('city') is-invalid @enderror" id="city"
                                        required>
                                        @forelse($cities as $city)
                                            <option value="{{$city->id}}" {{ $shop->shopLocation->city->id == $city->id ? 'selected' : '' }}>
                                                {{ $city->name }}
                                            </option>
                                        @empty 
                                            <div class="alert alert-warning" role="alert">
                                                No cities cities to show, contact admin for help!
                                            </div>
                                        @endforelse
                                    </select>

                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="postal_code">Postal Code</label>
                                    <input type="text" name="postal_code" class="form-control @error('postal_code') is-invalid @enderror" value="{{ $shop->shopLocation->postal_code }}" id="postal_code" 
                                        required>
                                    
                                    @error('postal_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="street">Street Name</label>
                                    <input type="text" name="street" class="form-control @error('street') is-invalid @enderror" value="{{ $shop->shopLocation->street }}" id="street" 
                                        required>
                                    
                                    @error('postal_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="building">Building Number</label>
                                    <input type="text" name="building" class="form-control @error('building') is-invalid @enderror" value="{{ $shop->shopLocation->building }}" id="building" 
                                        required>
                                    
                                    @error('building')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="specific_information">Specific Location Information</label>
                                    <textarea type="text" rows="3" name="specific_information" id="specific_information" class="form-control @error('specific_information') is-invalid @enderror" 
                                    required>{{$shop->shopLocation->specific_information}}</textarea>

                                    @error('specific_information')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea type="text" rows="2" name="address" id="address" class="form-control @error('address') is-invalid @enderror" 
                                    required>{{$shop->shopLocation->address}}</textarea>

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="latitude">Latitude</label>
                                        <input type="text" name="latitude" class="form-control @error('latitude') is-invalid @enderror" value="{{ $shop->shopLocation->latitude }}" id="latitude" 
                                            required>
                                        
                                        @error('latitude')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="longitude">Longitude</label>
                                        <input type="text" name="longitude" class="form-control @error('longitude') is-invalid @enderror" value="{{ $shop->shopLocation->longitude }}" id="longitude" 
                                            required>
                                        
                                        @error('longitude')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                    
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                        <!-- /.card -->
                    </form>
                </div>
            </div>
        </div>
    <!-- /.content -->
    </section>
@endsection