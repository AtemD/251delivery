@extends('dashboard.retailer.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Product Editor</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('retailer.shops.index', ['shop' => $shop])}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('retailer.products.index', ['shop' => $shop])}}">Products</a></li>
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
                <div class="col-md-6">
                    <!-- form start -->
                    <form role="form" method="POST" action="{{ route('retailer.products.update', ['shop' => $shop, 'product' => $product->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <!-- general form elements -->
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Edit Product Details</h3>
                            </div>
                            <!-- /.card-header --> 
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $product->name }}" id="name" 
                                        placeholder="e.g Special Pizza" required>
                                    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="image">Choose Image Update</label>
                                        <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image">

                                        @error('image')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-8">
                                        <img class="img-fluid mb-3 img-thumbnail" style="height: 90px; width:120px;" src="{{$product->imagePath}}" alt="Photo">
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
                                    <label for="section">Section</label>
                                    <select name="section" class="form-control @error('section') is-invalid @enderror" id="section"
                                        required>
                                        @forelse($shop->sections as $section)
                                            <option value="{{$section->id}}" {{ $product->section->id == $section->id ? 'selected' : '' }}>
                                                {{ $section->name }}
                                            </option>
                                        @empty 
                                            <div class="alert alert-warning" role="alert">
                                                No sections created for this shop!
                                            </div>
                                        @endforelse
                                    </select>

                                    @error('section')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea type="text" rows="4" name="description" id="description" class="form-control @error('description') is-invalid @enderror" 
                                    required>{{$product->description}}</textarea>

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="base_price">Base Price</label>
                                    <input type="text" name="base_price" class="form-control @error('base_price') is-invalid @enderror" value="{{ $product->base_price }}" id="base_price" 
                                        placeholder="e.g 35.00 (without extra fees like tax)" required>
                                    
                                    @error('base_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="status" name="status" 
                                            {{$product->is_available === 1 ? 'checked' : ''}}>
                                        <label class="custom-control-label" for="status"><small class="text-muted">(available/unavailable)</small></label>
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
                                <button type="submit" class="btn btn-primary">Update Product Details</button>
                            </div>
                        </div>
                    </form>
                    <!-- /.card -->
                </div>
                <div class="col-md-3">
                    <form role="form" method="POST" action="{{ route('retailer.product.taxes.update', ['shop' => $shop, 'product' => $product->id]) }}">
                        @method('PUT')
                        @csrf
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Edit Product Tax</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="taxes">Apply Taxes</label>
                                    <p><small class="text-muted">Apply Tax For This Product or (<a href="#">create a tax</a>) to assign to this product</small></p>
                                    <div class="row">
                                        @forelse($shop->taxes as $tax)
                                            <div class="col-md-4">
                                                <div class="form-group form-check">
                                                    <input type="checkbox" name="taxes[]" value="{{$tax->id}}" class="form-check-input" id="add-tax-{{$tax->id}}" 
                                                        {{ ($product->taxes->contains($tax->id)) ? ' checked' : '' }}>
                                                    <label class="form-check-label" for="add-tax-{{$tax->id}}">{{$tax->name}}</label>
                                                </div>
                                            </div>
                                        @empty 
                                            <div class="alert alert-warning" role="alert">
                                                No taxes Created Yet, <small>Go to taxes to create one</small>
                                            </div>
                                        @endforelse
                                    </div>

                                    @error('taxes')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Product Tax</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-3">
                    <form role="form" method="POST" action="{{ route('retailer.product.discounts.update', ['shop' => $shop, 'product' => $product->id]) }}">
                        @method('PUT')
                        @csrf
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Edit Product Discounts</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="discounts">Apply Discounts <small>(optional)</small></label>
                                    <p><small class="text-muted">Apply Discount For This Product or (<a href="#">create a discount</a>) to assign to this product</small></p>
                                    <div class="row">
                                        @forelse($shop->discounts as $discount)
                                            <div class="col-md-4">
                                                <div class="form-group form-check">
                                                    <input type="checkbox" name="discounts[]" value="{{$discount->id}}" class="form-check-input" id="add-discount-{{$discount->id}}" 
                                                        {{ ($product->discounts->contains($discount->id)) ? ' checked' : '' }}>
                                                    <label class="form-check-label" for="add-discount-{{$discount->id}}">{{$discount->name}}</label>
                                                </div>
                                            </div>
                                        @empty 
                                            <div class="alert alert-warning" role="alert">
                                                No discounts Created Yet, <small>Go to discounts to create one</small>
                                            </div>
                                        @endforelse
                                    </div>

                                    @error('discounts')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Product Discount</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!-- /.content -->
    </section>
@endsection