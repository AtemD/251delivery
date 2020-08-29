@extends('dashboard.company.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Permissions</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('company.home')}}">Home</a></li>
                    <li class="breadcrumb-item">Settings</li>
                    <li class="breadcrumb-item active">Permissions</li>
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
                                <button href="#add-permission" class="btn btn-primary" data-toggle="modal" data-target="#add-permission">
                                    <i class="fas fa-plus xs"></i>
                                    Add Permission
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
                                <th>Guard Name</th>
                                <th>Roles Associated</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($permissions as $permission)
                                    <tr>
                                        <td>{{$permission->id}}</td>
                                        <td>{{$permission->name}}</td>
                                        <td>{{$permission->guard_name}}</td>
                                        <td>
                                            @forelse($permission->roles as $role)
                                                <span class="badge badge-primary">{{$role->name}}</span>
                                            @empty 
                                                <div class="alert alert-warning" role="alert">
                                                    No roles assigned to this permission
                                                </div>
                                            @endforelse
                                        </td>
                                        <td class="project-actions">
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit-permission-{{$permission->id}}">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-permission-{{$permission->id}}">
                                                <i class="fas fa-trash">
                                                </i>
                                            </button>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="edit-permission-{{$permission->id}}" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog edit-permission-{{$permission->id}}">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit {{$permission->name}}</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <form permission="form" method="POST" action="{{ route('company.settings.permissions.update', ['permission' => $permission->id]) }}">
                                                @method('PUT')
                                                @csrf

                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" class="form-control" id="name" placeholder="name" name="name" value="{{ $permission->name }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="guard_name">Guard Name</label>
                                                        <input type="text" class="form-control" id="name" placeholder="guard name" name="guard_name" value="{{ $permission->guard_name }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="roles">Roles</label>
                                                        <div class="row">
                                                            @forelse($roles as $role)
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-check">
                                                                        <input type="checkbox" name="roles[]" value="{{$role->id}}" class="form-check-input" id="update-role-{{$role->id}}"
                                                                        {{$permission->roles->contains($role->id) ? 'checked' : ''}}>
                                                                        <label class="form-check-label" for="update-role-{{$role->id}}">{{$role->name}}</label>
                                                                    </div>
                                                                </div>
                                                            @empty 
                                                                <div class="alert alert-warning" role="alert">
                                                                    No roles to show
                                                                </div>
                                                            @endforelse
                                                        </div>
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

                                    <div class="modal fade" id="delete-permission-{{$permission->id}}" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog delete-permission-{{$permission->id}}">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Delete {{$permission->name}}</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <form permission="form" method="POST" action="{{ route('company.settings.permissions.destroy', ['permission' => $permission->id]) }}">
                                                @method('DELETE')
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="alert alert-danger" permission="alert">
                                                        Are you sure you want to delete <b>{{$permission->name}}</b> permission!
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
                                                <h5><i class="icon fas fa-warning"></i> No permission Registered Yet!</h5>
                                                register at least one permission.
                                            </div>
                                        </div>
                                    </div>
                                @endempty

                                <div class="modal fade" id="add-permission" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog add-permission">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h4 class="modal-title">Add New permission</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        </div>
                                        
                                        <form permission="form" method="POST" action="{{ route('company.settings.permissions.store') }}">
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
                                                    <label for="roles">Roles</label>
                                                    <div class="row">
                                                        @forelse($roles as $role)
                                                            <div class="col-md-4">
                                                                <div class="form-group form-check">
                                                                    <input type="checkbox" name="roles[]" value="{{$role->id}}" class="form-check-input" id="add-role-{{$role->id}}">
                                                                    <label class="form-check-label" for="add-role-{{$role->id}}">{{$role->name}}</label>
                                                                </div>
                                                            </div>
                                                        @empty 
                                                            <div class="alert alert-warning" role="alert">
                                                                No roles to show
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
                                {{$permissions->links()}}
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