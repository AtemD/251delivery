@extends('dashboard.retailer.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Section Editor</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('retailer.shops.index', ['shop' => $shop])}}">Home</a></li>
                    <li class="breadcrumb-item">Settings</li>
                    <li class="breadcrumb-item"><a href="{{route('retailer.sections.index', ['shop' => $shop])}}">Sections</a></li>
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
                    <!-- general form elements -->
                    <form role="form" method="POST" action="{{ route('retailer.sections.update', ['shop' => $shop, 'section' => $section]) }}">
                        @method('PUT')
                        @csrf
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Edit <strong>{{$section->name}}</strong> Section</h3>
                            </div>
                            <!-- /.card-header -->
                            
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $section->name }}" id="name" 
                                        placeholder="e.g Luch" required>
                                    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea type="text" rows="4" name="description" id="description" class="form-control @error('description') is-invalid @enderror" 
                                    required>{{$section->description}}</textarea>

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                    <!-- /.card -->
                </div>
                <div class="col-md-6">
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <h3 class="card-title">This Sections Products: </h3>
                        </div>
                        <!-- /.card-header -->
                        
                        <div class="card-body">
                            <div class="row">
                                @forelse($section->products as $product)
                                    <div class="col-md-6">
                                        <li>{{$product->name}}</li>
                                    </div>
                                @empty 
                                    No product Assigned To This Section
                                @endforelse
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-info">
                                        <h5><i class="icon fas fa-info"></i> Note!</h5>
                                        To add more products to this section, go to products list, chooose a product and edit its section.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- /.content -->
    </section>
@endsection