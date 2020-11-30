@extends('dashboard.retailer.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Order History</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('retailer.shops.index', ['shop' => $shop])}}">Home</a></li>
                    <li class="breadcrumb-item active">order history</li>
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
                            ...
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>No.</th>
                                <th>Customer</th>
                                <th>Type</th>
                                <th>Address</th>
                                <th>PaymentMethod</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    <tr>
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->number}}</td>
                                        <td>{{$order->user->first_name }}</td>
                                        <td>{{$order->orderType->name }}</td>
                                        <td>{{$order->delivery_address }}</td>
                                        <td>{{$order->paymentMethod->name }}</td>
                                        <td>
                                          <span class="badge badge-{{ $order->orderStatus->color }}">{{$order->orderStatus->name }}</span>
                                        </td>
                                        <td>{{$order->created_at->diffForHumans() }}</td>
                                        <td class="project-actions">
                                            <a class="btn btn-info btn-sm" href="#" role="button">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-order-{{$order->id}}">
                                                <i class="fas fa-trash">
                                                </i>
                                            </button>
                                        </td>
                                    </tr>

                                @empty
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-warning">
                                                <h5><i class="icon fas fa-warning"></i> No order Yet!</h5>
                                                Get at least one order to register.
                                            </div>
                                        </div>
                                    </div>
                                @endempty

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                </div>
            </div>
        </div>
    <!-- /.content -->
    </section>
@endsection
