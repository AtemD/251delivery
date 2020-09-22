@extends('dashboard.retailer.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Your Shops</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('retailer.shops.index', ['shop' => $shop])}}">Home</a></li>
                <li class="breadcrumb-item active">Products</li>
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
                <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools float-left">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
            
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    
                        <div class="card-tools">
                            <retailer-product-add :shop="{{$shop}}" :sections="{{$sections}}"></retailer-product-add>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Base Price</th>
                                    <th>Description</th>
                                    <th>Section</th>
                                    <th>Availability</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                    <tr>
                                        <td>{{$product->name}}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <img class="img-fluid mb-3" style="height: 50px; width:80px;" src="{{$product->imagePath}}" alt="Photo">
                                                </div>
                                            </div>     
                                        </td>
                                        <td>{{$product->price}} ETB</td>
                                        <td>{{$product->shortDescription }}...</td>
                                        <td>{{$product->section->name}}</td>

                                        <td><span class="badge badge-{{$product->is_available == 1 ? 'primary': 'warning'}}">{{$product->is_available === 1 ? 'available': 'unavailable'}}</span></td>
                                        <td class="project-actions">
                                            <retailer-product-edit :shop="{{$shop}}" :sections="{{$sections}}" :product="{{$product}}"></retailer-product-edit>
                                            <retailer-product-delete :shop="{{$shop}}" :product="{{$product}}"></retailer-product-delete>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-warning">
                                                <h5><i class="icon fas fa-warning"></i> No shop Registered Yet!</h5>
                                                Register at least one shop.
                                            </div>
                                        </div>
                                    </div>
                                @endempty
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            {{$products->links()}}
                        </ul>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
                </div>
            </div>
        </div>
    <!-- /.content -->
    </section>
@endsection 