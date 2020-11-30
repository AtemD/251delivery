@extends('dashboard.retailer.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Discount</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('retailer.shops.index', ['shop' => $shop])}}">Home</a></li>
                    <li class="breadcrumb-item">Settings</li>
                    <li class="breadcrumb-item"><a href="{{route('retailer.discounts.index', ['shop' => $shop])}}">Discounts</a></li>
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
                    <!-- general form elements --><div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Discount: <strong>{{$discount->name}}</strong></h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="POST" action="{{ route('retailer.discounts.update', ['shop' => $shop, 'discount' => $discount->id]) }}">
                                @method('PUT')
                                @csrf 
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $discount->name }}" id="name" 
                                            placeholder="e.g Holiday Discount" required>
                                        
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
        
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="rate">Rate</label>
                                            <input type="text" name="rate" class="form-control @error('rate') is-invalid @enderror" value="{{ $discount->modified_rate }}" id="rate" 
                                                placeholder="e.g 15.00" required>

                                            @error('rate')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="rate_type">Rate Type</label>
                                            <select name="rate_type" class="form-control @error('rate_type') is-invalid @enderror" id="rate_type" 
                                                required>
                                                <option value="{{App\Models\Discount::PERCENTAGE_DISCOUNT}}" {{ $discount->rate_type == App\Models\Discount::PERCENTAGE_DISCOUNT ? 'selected' : '' }}>
                                                    {{App\Models\Discount::PERCENTAGE_DISCOUNT}} (%)
                                                </option>
                                                <option value="{{App\Models\Discount::CURRENCY_DISCOUNT}}" {{ $discount->rate_type == App\Models\Discount::CURRENCY_DISCOUNT ? 'selected' : '' }}>
                                                    {{App\Models\Discount::CURRENCY_DISCOUNT}} (ETB)
                                                </option>
                                            </select>

                                            @error('rate_type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="shop">Shop</label>
                                        <select name="shop" class="form-control @error('shop') is-invalid @enderror" id="shop"
                                            required>
                                            <option value="{{$shop->slug}}" selected>
                                                {{ $shop->name }}
                                            </option>
                                        </select>

                                        @error('shop')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    
                                    <div class="form-group">
                                        <label>Status</label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="status" name="status" 
                                                {{$discount->is_enabled === 1 ? 'checked' : ''}}>
                                            <label class="custom-control-label" for="status"><small class="text-muted">(enable/disable)</small></label>
                                        </div>

                                        @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                                <!-- /.card-body -->
                        
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    <!-- /.content -->
    </section>
@endsection