@extends('dashboard.retailer.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Products</h1>
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
                                    <th>Availability</th>
                                    <th>Image</th>
                                    <th>Base Price</th>
                                    <th>Taxes</th>
                                    <th>Discounts</th>
                                    <th>Section</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                    <tr>
                                        <td>{{$product->name}}</td>
                                        <td>
                                            <retailer-product-availability-button :shop="{{$shop}}" :product="{{$product}}"></retailer-product-availability-button>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <img class="img-fluid mb-3" style="height: 50px; width:80px;" src="{{$product->imagePath}}" alt="Photo">
                                                </div>
                                            </div>     
                                        </td>
                                        <td>{{$product->modified_base_price}} ETB</td>
                                        <td>
                                            @forelse($product->taxes as $tax)
                                                <li>{{$tax->name}} ({{ $tax->modified_rate}}{{ $tax->rate_type == 'percentage' ? '%': '' }})</li>
                                            @empty
                                                <div class="alert alert-info text-wrap" role="alert">
                                                    <small class="text-muted">*No Taxes Assigned</small>
                                                </div>
                                            @endforelse
                                        </td>
                                        <td>
                                            @forelse($product->discounts as $discount)
                                                <li>{{$discount->name}} ({{ $discount->modified_rate}}{{ $discount->rate_type == 'percentage' ? '%': ' ETB' }})</li>
                                            @empty
                                            <div class="alert alert-info text-wrap" role="alert">
                                                <small class="text-muted">*No Discounts Assigned</small>
                                            </div>
                                            @endforelse
                                        </td>
                                        <td>{{$product->section->name}}</td>

                                        <td class="project-actions">
                                            <a class="btn btn-info btn-sm" href="{{ route('retailer.products.edit', ['shop'=> $shop, 'product' => $product->id]) }}" role="button">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-product-{{$product->id}}">
                                                <i class="fas fa-trash">
                                                </i>
                                            </button>

                                            <div class="modal fade" id="delete-product-{{$product->id}}" style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title text-danger">Delete {{$product->name}}</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <form role="form" method="POST" action="{{ route('retailer.products.destroy', ['shop' => $shop, 'product' => $product->id]) }}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="alert alert-danger alert-dismissible">
                                                                <h5><i class="icon fas fa-ban"></i> Warning!</h5>
                                                                Are you sure you want to delete the product: 
                                                                <br><strong>{{$product->name}}</strong>?
                                                                <br><p>This action is irreversible!</p>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">No Close</button>
                                                            <button type="submit" class="btn btn-danger" id="button">Yes Delete</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>

                                        </td>
                                    </tr>
                                @empty
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-warning">
                                                <h5><i class="icon fas fa-exclamation-triangle"></i> No Products Registered Yet!</h5>
                                                Please click on "Add Product" button above to add a new product.
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