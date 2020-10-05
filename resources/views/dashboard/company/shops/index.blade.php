@extends('dashboard.company.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Shops List</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('company.home')}}">Home</a></li>
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
                            <button href="#add-shop" class="btn btn-primary" data-toggle="modal" data-target="#add-shop">
                                <i class="fas fa-store-alt"></i>
                                <i class="fas fa-plus xs"></i>
                                Add Shop
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Type</th>
                            <th>Account Status</th>
                            <th>Availablity</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($shops as $shop)
                                <tr>
                                    <td>{{$shop->id}}</td>
                                    <td>{{$shop->name}}</td>
                                    <td>
                                        {{$shop->phone_number}}<br>
                                        {{$shop->email}}
                                    </td>
                                    <td>{{$shop->shopType->name}}</td>
                                    <td><span class="badge badge-{{$shop->ShopAccountStatus->color}}">{{$shop->shopAccountStatus->name}}</span></td>
                                    <td><span class="badge badge-{{$shop->is_available == 1 ? 'primary': 'secondary'}}">{{$shop->is_available == 1 ? 'Available': 'Unavailable'}}</span></td>
                                    <td class="project-actions">
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit-shop-{{$shop->id}}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-shop-{{$shop->id}}">
                                            <i class="fas fa-trash">
                                            </i>
                                        </button>
                                    </td>
                                </tr>

                                <div class="modal fade" id="edit-shop-{{$shop->id}}" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog edit-shop-{{$shop->id}}">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit {{$shop->name}}</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="row">
                            
                                                <div class="col-md-12">
                                                    <!-- select -->
                                                    <div class="form-group">
                                                        <label>Shop Type</label>
                                                        <select class="form-control">
                                                            @foreach($shop_types as $shop_type)
                                                                <option>{{ $shop_type->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <!-- select -->
                                                    <div class="form-group">
                                                        <label>Shop Account Status</label>
                                                        <select class="form-control">
                                                            @foreach($shop_account_statuses as $account_status)
                                                                <option>{{ $account_status->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>

                                <div class="modal fade" id="delete-shop-{{$shop->id}}" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog delete-shop-{{$shop->id}}">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h4 class="modal-title">Delete {{$shop->name}}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                        <p>One fine body…</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>

                            @empty
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-warning">
                                            <h5><i class="icon fas fa-warning"></i> No Shop Registered Yet!</h5>
                                            Get at least one shop to register.
                                        </div>
                                    </div>
                                </div>
                            @endempty

                            <div class="modal fade" id="add-shop" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog add-shop">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Add New Shop</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    </div>
                                    
                                    <form role="form">
                                        <div class="modal-body">
                                            <p>One fine body…</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>

                                </div>
                                <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>

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
@endsection