@extends('dashboard.retailer.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Your Shops</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('retailer.home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Shops</li>
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
                                <retailer-add-shop-component :shoptypes="{{$shop_types}}"></retailer-add-shop-component>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Contact</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Availability</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($shops as $shop)
                                        <tr>
                                            <td>{{$shop->name}}</td>
                                            <td>{!! mb_substr($shop->description, 0,35) !!}...</td>
                                            <td>
                                                {{$shop->phone_number}} <br>
                                                {{$shop->email}}
                                            </td>
                                            <td>{{$shop->shopType->name}}</td>
                                            <td>
                                                <span class="badge badge-{{!empty($shop->shopAccountStatus) ? $shop->shopAccountStatus->color: 'secondary'}}">
                                                    {{!empty($shop->shopAccountStatus) ? $shop->shopAccountStatus->name: 'Unverified'}}
                                                </span>
                                            </td>

                                            <td><span class="badge badge-{{$shop->is_available == 1 ? 'primary': 'warning'}}">{{$shop->is_available === 1 ? 'online': 'offline'}}</span></td>
                                            <td class="project-actions">
                                                <div>
                                                    <retailer-edit-shop-component :shop="{{$shop}}" :shoptypes="{{$shop_types}}"></retailer-edit-shop-component>
                                                    <retailer-delete-shop-component :shop="{{$shop}}"></retailer-delete-shop-component>
                                                </div>
                                                
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
                                {{$shops->links()}}
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