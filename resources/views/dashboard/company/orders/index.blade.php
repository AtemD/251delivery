@extends('dashboard.company.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Orders List</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('company.home')}}">Home</a></li>
                <li class="breadcrumb-item active">Orders</li>
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
                            <button href="#add-order" class="btn btn-primary" data-toggle="modal" data-target="#add-order">
                                <i class="fas fa-order-plus xs"></i>
                                Add order
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>User Full Name</th>
                            <th>Phone</th>
                            <th>Order Type</th>
                            <th>Order Status</th>
                            <th>Payment Method</th>
                            <th>Delivery Address</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->user->full_name}}</td>
                                    <td>{{$order->user->phone_number}}</td>
                                    <td>{{$order->orderType->name}}</td>
                                    <td>{{$order->orderStatus->name}}</td>
                                    <td>{{$order->paymentMethod->name}}</td>
                                    <td>{{$order->delivery_address}}</td>
                                    <td class="project-actions">
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit-order-{{$order->id}}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-order-{{$order->id}}">
                                            <i class="fas fa-trash">
                                            </i>
                                        </button>
                                    </td>
                                </tr>

                                <div class="modal fade" id="edit-order-{{$order->id}}" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog edit-order-{{$order->id}}">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"><b>Edit</b> {{$order->full_name}}</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="row">
                            
                                                <div class="col-md-12">
                                                    <!-- select -->
                                                    <div class="form-group">
                                                        <label>order Status</label>
                                                        <select class="form-control">
                                                            @foreach($order_statuses as $status)
                                                                <option>{{ $status->name }}</option>
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

                                <div class="modal fade" id="delete-order-{{$order->id}}" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog delete-order-{{$order->id}}">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h4 class="modal-title">Delete {{$order->full_name}}</h4>
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
                                            <h5><i class="icon fas fa-warning"></i> No order Registered Yet!</h5>
                                            Get at least one order to register.
                                        </div>
                                    </div>
                                </div>
                            @endempty

                            <div class="modal fade" id="add-order" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog add-order">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Add New order</h4>
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
                            {{$orders->links()}}
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