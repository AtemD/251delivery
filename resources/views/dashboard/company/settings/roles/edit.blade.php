@extends('dashboard.company.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Role Editor</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('company.home')}}">Home</a></li>
                    <li class="breadcrumb-item">Settings</li>
                    <li class="breadcrumb-item">ACL</li>
                    <li class="breadcrumb-item"><a href="{{route('company.roles.index')}}">Roles</a></li>
                    <li class="breadcrumb-item active">Edit</li>
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
                <div class="col-md-6">
                    <!-- form start -->
                    <form role="form" method="POST" action="{{ route('company.roles.update', ['role' => $role]) }}">
                        @method('PUT')
                        @csrf 
                        <!-- general form elements -->
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Edit <strong>{{$role->name}}</strong> Role</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $role->name }}" id="name" 
                                        placeholder="e.g Administrator" required>
                                    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="guard_name">Guard Name</label>
                                    <input type="text" name="guard_name" class="form-control @error('guard_name') is-invalid @enderror" value="{{ $role->guard_name }}" id="guard_name" 
                                        placeholder="e.g Administrator" required>
                                    
                                    @error('guard_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <!-- /.card-body -->
                    
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Role</button>
                            </div>
                        </div>
                        <!-- /.card -->
                    </form>
                </div>
                <div class="col-md-6">
                    <!-- form start -->
                    <form role="form" method="POST" action="{{ route('company.role.permissions.update', ['role' => $role]) }}">
                        @method('PUT')
                        @csrf 
                        <!-- general form elements -->
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Edit <strong>{{$role->name}}</strong> Role Permissions</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="permissions">Select Permissions to Assign to This Role</label>
                                    <p><small class="text-muted">*If the permissions you want to assign are not in the list, please first create them.</small></p>
                                    <div class="row">
                                        @forelse($permissions as $permission)
                                            <div class="col-md-4">
                                                <div class="form-group form-check">
                                                    <input type="checkbox" name="permissions[]" value="{{$permission->id}}" class="form-check-input" id="add-permission-{{$permission->id}}" 
                                                        {{ ($role->permissions->contains($permission->id)) ? ' checked' : '' }}>
                                                    <label class="form-check-label" for="add-permission-{{$permission->id}}">
                                                        {{$permission->name}}
                                                    </label>
                                                </div>
                                            </div>
                                        @empty 
                                            <div class="alert alert-warning" role="alert">
                                                No permissions Created Yet, <small>Go to permissions to create one</small>
                                            </div>
                                        @endforelse
                                    </div>

                                    @error('permissions')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->
                    
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Role Permissions</button>
                            </div>
                        </div>
                        <!-- /.card -->
                    </form>
                </div>
            </div>
        </div>
    <!-- /.content -->
    </section>
@endsection