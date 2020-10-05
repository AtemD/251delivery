@extends('dashboard.company.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Roles</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('company.home')}}">Home</a></li>
                <li class="breadcrumb-item">Settings</li>
                <li class="breadcrumb-item active">Roles</li>
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
                            <company-role-add></company-role-add>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Guard Name</th>
                            <th>Permissions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($roles as $role)
                                <tr>
                                    <td>{{$role->id}}</td>
                                    <td>{{$role->name}}</td>
                                    <td>{{$role->guard_name}}</td>
                                    <td class="text-wrap">
                                        @forelse($role->permissions as $permission)
                                            <span class="badge badge-primary">{{$permission->name}}</span>
                                        @empty 
                                            <div class="alert alert-warning" role="alert">
                                                No permissions assigned to this role
                                            </div>
                                        @endforelse
                                    </td>
                                    <td class="project-actions">

                                        <a class="btn btn-info btn-sm" href="{{ route('company.roles.edit', ['role' => $role]) }}" role="button">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-role-{{$role->id}}">
                                            <i class="fas fa-trash">
                                            </i>
                                        </button>

                                        <div class="modal fade" id="delete-role-{{$role->id}}" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Delete {{$role->name}} Role</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
    
                                                    <form role="form" method="POST" action="{{ route('company.roles.destroy', ['role' => $role]) }}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="alert alert-danger" role="alert">
                                                                <h5><i class="icon fas fa-ban"></i> Warning!</h5>
                                                                <small class="text-danger">*This action is irreversible!</small><br>
                                                                <p class="text-wrap">Are you sure you want to delete this role?</p>
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
                                            <h5><i class="icon fas fa-warning"></i> No role Registered Yet!</h5>
                                            register at least one role.
                                        </div>
                                    </div>
                                </div>
                            @endempty

                            <div class="modal fade" id="add-role" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog add-role">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Add New role</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    </div>
                                    
                                    <form role="form" method="POST" action="{{ route('company.roles.store') }}">
                                        @csrf

                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name" placeholder="name" name="name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="guard_name">Guard Name</label>
                                                <input type="text" class="form-control" id="name" placeholder="guard name" name="guard_name" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="permissions">Permissions</label>
                                                <div class="row">
                                                    @forelse($permissions as $permission)
                                                        <div class="col-md-4">
                                                            <div class="form-group form-check">
                                                                <input type="checkbox" name="permissions[]" value="{{$permission->id}}" class="form-check-input" id="add-permission-{{$permission->id}}">
                                                                <label class="form-check-label" for="add-permission-{{$permission->id}}">{{$permission->name}}</label>
                                                            </div>
                                                        </div>
                                                    @empty 
                                                        <div class="alert alert-warning" role="alert">
                                                            No permissions to show
                                                        </div>
                                                    @endforelse
                                                </div>
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
                            {{$roles->links()}}
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