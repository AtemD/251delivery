@extends('dashboard.company.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Shop Account Statuses</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('company.home')}}">Home</a></li>
                    <li class="breadcrumb-item">Settings</li>
                    <li class="breadcrumb-item active">Shop Account Statuses</li>
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
                                <button href="#add-shop-account-status" class="btn btn-primary" data-toggle="modal" data-target="#add-shop-account-status">
                                    <i class="fas fa-plus xs"></i>
                                    Add Shop Account Status
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
                                @forelse($shop_account_statuses as $shop_account_status)
                                    <tr>
                                        <td>{{$shop_account_status->id}}</td>
                                        <td>{{$shop_account_status->name}}</td>
                                        <td>{{$shop_account_status->description}}</td>
                                        <td>{{$shop_account_status->color}}</td>
                                        <td class="project-actions">
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit-shop-account-status-{{$shop_account_status->id}}">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-shop-account-status-{{$shop_account_status->id}}">
                                                <i class="fas fa-trash">
                                                </i>
                                            </button>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="edit-shop-account-status-{{$shop_account_status->id}}" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog edit-shop-account-status-{{$shop_account_status->id}}">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit {{$shop_account_status->name}}</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <form role="form" method="POST" action="{{ route('company.settings.shop-account-statuses.update', ['shop_account_status' => $shop_account_status->id]) }}">
                                                @method('PUT')
                                                @csrf

                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" class="form-control" id="name" placeholder="name" name="name" value="{{ $shop_account_status->name }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="description">Description</label>
                                                        <textarea class="form-control" id="description" rows="3" name="description" required>{{ $shop_account_status->description }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="color">Color</label>
                                                        <input type="text" class="form-control" id="color" placeholder="color to be used" name="color" value="{{ $shop_account_status->color }}" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>

                                    <div class="modal fade" id="delete-shop-account-status-{{$shop_account_status->id}}" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog delete-shop-account-status-{{$shop_account_status->id}}">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Delete {{$shop_account_status->name}}</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <form role="form" method="POST" action="{{ route('company.settings.shop-account-statuses.destroy', ['shop_account_status' => $shop_account_status->id]) }}">
                                                @method('DELETE')
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="alert alert-danger" role="alert">
                                                        Are you sure you want to delete <b>{{$shop_account_status->name}}</b> Shop Account Status!
                                                        <br>
                                                        <small>This action is irreversible!</small>
                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>

                                @empty
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-warning">
                                                <h5><i class="icon fas fa-warning"></i> No Shop Account Status Registered Yet!</h5>
                                                register at least one Shop Account Status.
                                            </div>
                                        </div>
                                    </div>
                                @endempty

                                <div class="modal fade" id="add-shop-account-status" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog add-shop-account-status">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add New Shop Account Status</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        
                                        <form role="form" method="POST" action="{{ route('company.settings.shop-account-statuses.store') }}">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" id="name" placeholder="shop account status name" name="name" required>
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
                                {{$shop_account_statuses->links()}}
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