@extends('dashboard.company.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Order Types</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('company.home')}}">Home</a></li>
                <li class="breadcrumb-item">Settings</li>
                <li class="breadcrumb-item active">Order Types</li>
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
                            <company-order-type-add></company-order-type-add>
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
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($order_types as $order_type)
                                <tr>
                                    <td>{{$order_type->id}}</td>
                                    <td>{{$order_type->name}}</td>
                                    <td>
                                        {{$order_type->description}}
                                    </td>
                                    <td><span class="badge badge-{{$order_type->is_enabled == 1 ? 'primary': 'warning'}}">{{$order_type->is_enabled == 1 ? 'enabled': 'disabled'}}</span></td>
                                    <td class="project-actions">
                                        <a class="btn btn-info btn-sm" href="{{ route('company.order-types.edit', ['order_type' => $order_type]) }}" role="button">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-order-type-{{$order_type->id}}">
                                            <i class="fas fa-trash">
                                            </i>
                                        </button>

                                        <div class="modal fade" id="delete-order-type-{{$order_type->id}}" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Delete {{$order_type->name}} Order Type</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
    
                                                    <form role="form" method="POST" action="{{ route('company.order-types.destroy', ['order_type' => $order_type]) }}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="alert alert-danger" role="alert">
                                                                <h5><i class="icon fas fa-ban"></i> Warning!</h5>
                                                                <small class="text-danger">*This action is irreversible!</small><br>
                                                                <p class="text-wrap">Are you sure you want to delete this order type?</p>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">No Close</button>
                                                            <button type="submit" class="btn btn-danger">Yes Delete</button>
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
                                            <h5><i class="icon fas fa-warning"></i> No Order Type Registered Yet!</h5>
                                            register at least one order type.
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
                            {{$order_types->links()}}
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