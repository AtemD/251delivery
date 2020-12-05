@extends('dashboard.buyer.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Orders</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('buyers.home')}}">Home</a></li>
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
                            <a href="/" class="btn btn-primary">
                                Place New Order
                                <i class="fas fa-angle-double-right xs"></i>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover m-0">
                            <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Order Type</th>
                                <th>Delivery Addr.</th>
                                <th>Payment Method</th>
                                <th>Product</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Order Date</th>
                                <th>More</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                <tr>
                                    <td><a href="pages/examples/invoice.html">{{$order->id}}</a></td>
                                    <td>{{ $order->orderType->name }}</td>
                                    <td>{{ $order->delivery_address }}</td>
                                    <td>{{ $order->paymentMethod->name }}</td>
                                    <td>
                                        @forelse($order->products as $product)
                                            {{$product->name}} (x{{$product->pivot->quantity}}),
                                        @empty 
                                            No product ordered
                                        @endforelse
                                    </td>
                                    <td>150.00ETB</td>
                                    <td><span class="badge badge-{{$order->orderStatus->color}}">{{$order->orderStatus->name}}</span></td>
                                    <td>{{ $order->created_at->diffForHumans() }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-info">
                                            <i class="fas fa-info"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <div class="row my-2">
                                    <div class="col-md-10 offset-1">
                                    <div class="alert alert-info alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <h5><i class="icon fas fa-info"></i> You haven't yet place any Order!</h5>
                                        <small>Please <a href="/">(click here)</a> to make your first order</small>
                                    </div>
                                    </div>
                                </div>
                                @endforelse
        
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