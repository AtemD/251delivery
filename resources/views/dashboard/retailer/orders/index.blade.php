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
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-between">
                                    <form role="form" method="GET" action="{{route('retailer.orders.index', ['shop'=>$shop])}}">
                                        <div class="card-tools float-left">
                                            <div class="input-group input-group-md">
                                                <input type="text" name="global_order_search" value="{{request()->input('global_order_search')}}" class="form-control float-right" placeholder="search order number">
                            
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                                </div>
                                                @error('global_order_search')
                                                    <span class="text-danger">
                                                        <strong>*{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </form>
                                
                                    <div class="card-tools">
                                        <button href="#add-order" class="btn btn-primary" data-toggle="modal" data-target="#add-order">
                                            <i class="fas fa-order-plus xs"></i>
                                            Add order
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <form role="form" method="GET" action="{{route('retailer.orders.index', ['shop'=> $shop])}}">
                                        {{-- @method('PUT')
                                        @csrf --}}
                                        <div class="form-row">
                                            <div class="col-md-1">
                                                <label for="page_size">Page Size</label>
                                                <select name="page_size" class="form-control @error('page_size') is-invalid @enderror" id="page_size">
                                                    <option value="10" {{collect(request()->input('page_size'))->contains('10') ? 'selected' : ''}}>10</option>
                                                    <option value="25" {{collect(request()->input('page_size'))->contains('25') ? 'selected' : ''}}>25</option>
                                                    <option value="50" {{collect(request()->input('page_size'))->contains('50') ? 'selected' : ''}}>50</option>
                                                    <option value="100" {{collect(request()->input('page_size'))->contains('100') ? 'selected' : ''}}>100</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="order_status">Order Status</label>
                                                <select name="order_status" class="form-control @error('order_status') is-invalid @enderror" id="order_status">
                                                    <option value="">Select...</option>
                                                    @forelse($order_statuses as $status)
                                                        <option value="{{$status->id}}" {{collect(request()->input('order_status'))->contains($status->id) ? 'selected' : ''}}>
                                                            {{ $status->name }}
                                                        </option>
                                                    @empty 
                                                        <div class="alert alert-warning" role="alert">
                                                            No order statuses created yet!
                                                        </div>
                                                    @endforelse
                                                </select>

                                                @error('order_status')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-2">
                                                <label for="order_type">Order Type</label>
                                                <select name="order_type" class="form-control @error('order_type') is-invalid @enderror" id="order_type">
                                                    <option value="">Select...</option>
                                                    @forelse($order_types as $type)
                                                        <option value="{{$type->id}}" {{collect(request()->input('order_type'))->contains($type->id) ? 'selected' : ''}}>
                                                            {{ $type->name }}
                                                        </option>
                                                    @empty 
                                                        <div class="alert alert-warning" role="alert">
                                                            No order types created yet!
                                                        </div>
                                                    @endforelse
                                                </select>

                                                @error('order_type')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-2">
                                                <label for="payment_method">Payment Method</label>
                                                <select name="payment_method" class="form-control @error('payment_method') is-invalid @enderror" id="payment_method">
                                                    <option value="">Select...</option>
                                                    @forelse($payment_methods as $method)
                                                        <option value="{{$method->id}}" {{collect(request()->input('payment_method'))->contains($method->id) ? 'selected' : ''}}>
                                                            {{ $method->name }}
                                                        </option>
                                                    @empty 
                                                        <div class="alert alert-warning" role="alert">
                                                            No payment methods created yet!
                                                        </div>
                                                    @endforelse
                                                </select>

                                                @error('payment_method')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-2 mt-4">
                                                <button type="submit" class="btn btn-primary btn-block mt-2">Search</button>
                                            </div>
                                        
                                        </div> 
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Number</th>
                                    <th>User <br> Info</th>
                                    <th>Order <br>Type</th>
                                    <th>Order <br>Status</th>
                                    <th>Payment <br> Method</th>
                                    <th>Date <br>&Time</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders as $order)
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->number}}</td>
                                            <td>
                                                {{$order->user->full_name}}<br>
                                                <small class="text-muted">{{$order->user->phone_number}}</small><br>
                                                <small class="text-muted">{{$order->delivery_address}}</small>
                                            </td>
                                            <td>{{$order->orderType->name}}</td>
                                            <td>
                                                <span class="badge badge-{{$order->orderStatus->color}}">{{$order->orderStatus->name}}</span>
                                            </td>
                                            <td>{{$order->paymentMethod->name}}</td>
                                            <td>
                                                <small class="text-muted">created:</small> {{$order->created_at->diffForHumans()}}<br>
                                                <small class="text-muted">updated:</small> {{$order->updated_at->diffForHumans() }}
                                            </td>
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
                                                    <h5><i class="icon fas fa-exclamation-triangle"></i> No Orders To Show!</h5>
                                                    Try to adjust your search filters.
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
