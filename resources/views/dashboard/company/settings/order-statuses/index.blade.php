@extends('dashboard.company.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Order Statuses</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('company.home')}}">Home</a></li>
                    <li class="breadcrumb-item">Settings</li>
                    <li class="breadcrumb-item active">Order Statuses</li>
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
                                <button href="#add-order-status" class="btn btn-primary" data-toggle="modal" data-target="#add-order-status">
                                    <i class="fas fa-plus xs"></i>
                                    Add Order Status
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
                                <th>Description</th>
                                <th>Color</th>
                                <th>Enabled Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($order_statuses as $order_status)
                                    <tr>
                                        <td>{{$order_status->id}}</td>
                                        <td>{{$order_status->name}}</td>
                                        <td>{{$order_status->description}}</td>
                                        <td>{{$order_status->color}}</td>
                                        <td class="project-actions">
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit-order-status-{{$order_status->id}}">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-order-status-{{$order_status->id}}">
                                                <i class="fas fa-trash">
                                                </i>
                                            </button>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="edit-order-status-{{$order_status->id}}" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog edit-order-status-{{$order_status->id}}">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit {{$order_status->name}}</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group{{ $errors->has('order-status') ? ' has-error' : '' }}">
                                                            <label for="order-status">Status Name</label>
                              
                                                            <input id="order-status" type="text" class="form-control" name="order-status" value="{{ $order_status->name }}" required>
                              
                                                            @if ($errors->has('order-status'))
                                                                <span class="help-block">
                                                                    <strong>*{{ $errors->first('order-status') }}</strong>
                                                                </span>
                                                            @endif
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

                                    <div class="modal fade" id="delete-order-status-{{$order_status->id}}" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog delete-order-status-{{$order_status->id}}">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h4 class="modal-title">Delete {{$order_status->name}}</h4>
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
                                                <h5><i class="icon fas fa-warning"></i> No Order Status Registered Yet!</h5>
                                                register at least one Order Status.
                                            </div>
                                        </div>
                                    </div>
                                @endempty

                                <div class="modal fade" id="add-order-status" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog add-order-status">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h4 class="modal-title">Add New Order Status</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        </div>
                                        
                                        <form role="form" method="POST" action="{{ route('company.settings.order-statuses.store') }}">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" id="name" placeholder="order status name" name="name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <textarea class="form-control" id="description" rows="3" name="description" required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="color">Color</label>
                                                    <input type="text" class="form-control" id="color" placeholder="e.g primary, secondary, etc" name="color" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Create</button>
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
                                {{$order_statuses->links()}}
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