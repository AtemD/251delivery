@extends('dashboard.company.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Cuisines</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('company.home')}}">Home</a></li>
                    <li class="breadcrumb-item">Settings</li>
                    <li class="breadcrumb-item active">Cuisines</li>
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
                                <button href="#add-cuisine" class="btn btn-primary" data-toggle="modal" data-target="#add-cuisine">
                                    <i class="fas fa-plus xs"></i>
                                    Add Cuisine
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
                                <th>Enabled Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($cuisines as $cuisine)
                                    <tr>
                                        <td>{{$cuisine->id}}</td>
                                        <td>{{$cuisine->name}}</td>
                                        <td>
                                            {{$cuisine->description}}
                                        </td>
                                        <td><span class="badge badge-{{$cuisine->is_enabled == 1 ? 'primary': 'warning'}}">{{$cuisine->is_enabled === 1 ? 'enabled': 'disabled'}}</span></td>
                                        <td class="project-actions">
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit-cuisine-{{$cuisine->id}}">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-cuisine-{{$cuisine->id}}">
                                                <i class="fas fa-trash">
                                                </i>
                                            </button>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="edit-cuisine-{{$cuisine->id}}" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog edit-cuisine-{{$cuisine->id}}">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit {{$cuisine->name}}</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <!-- select -->
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input" id="order-type-switch-{{$cuisine->id}}" value="{{$cuisine->is_enabled}}" name="toggle-cuisine-status" {{$cuisine->is_enabled === 1 ? 'checked' : ''}}>
                                                                <label class="custom-control-label" for="order-type-switch-{{$cuisine->id}}">Cuisine Status</label>
                                                            </div>
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

                                    <div class="modal fade" id="delete-cuisine-{{$cuisine->id}}" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog delete-cuisine-{{$cuisine->id}}">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h4 class="modal-title">Delete {{$cuisine->name}}</h4>
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
                                                <h5><i class="icon fas fa-warning"></i> No Cuisine Registered Yet!</h5>
                                                register at least one Cuisine.
                                            </div>
                                        </div>
                                    </div>
                                @endempty

                                <div class="modal fade" id="add-cuisine" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog add-cuisine">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h4 class="modal-title">Add New Cuisine</h4>
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
                                {{$cuisines->links()}}
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