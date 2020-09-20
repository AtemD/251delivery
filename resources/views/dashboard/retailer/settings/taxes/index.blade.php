@extends('dashboard.retailer.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Taxes</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('retailer.shops.index', ['shop' => $shop])}}">Home</a></li>
                    <li class="breadcrumb-item active">Taxes</li>
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
                                <retailer-tax-add :shop="{{$shop}}"></retailer-tax-add>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Rate</th>
                                        <th>Rate Type</th>
                                        <th>Shop</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($taxes as $tax)
                                        <tr>
                                            <td>{{$tax->name}}</td>
                                            <td>
                                                {{$tax->tax_rate}}    
                                            </td>
                                            <td>{{$tax->rate_type}}</td>
                                            <td>{{$shop->name }}</td>
                                            <td><span class="badge badge-{{$tax->is_enabled === 1 ? 'primary': 'warning'}}">{{$tax->is_enabled === 1 ? 'enabled': 'disabled'}}</span></td>
                                            <td class="project-actions">
                                                <retailer-tax-edit :shop="{{$shop}}" :tax="{{$tax}}"></retailer-tax-edit>
                                                <retailer-tax-delete :shop="{{$shop}}" :tax="{{$tax}}"></retailer-tax-delete>
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-warning">
                                                    <h5><i class="icon fas fa-warning"></i> No taxes registered Yet!</h5>
                                                    Click the add button to add a product tax.
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
                                {{$taxes->links()}}
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
    </div>
@endsection 