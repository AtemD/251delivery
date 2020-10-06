@extends('dashboard.company.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Permission Editor</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('company.home')}}">Home</a></li>
                    <li class="breadcrumb-item">Settings</li>
                    <li class="breadcrumb-item">ACL</li>
                    <li class="breadcrumb-item"><a href="{{route('company.permissions.index')}}">Permissions</a></li>
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
                    <form role="form" method="POST" action="{{ route('company.permissions.update', ['permission' => $permission]) }}">
                        @method('PUT')
                        @csrf 
                        <!-- general form elements -->
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Edit <strong>{{$permission->name}}</strong> Permission</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $permission->name }}" id="name" 
                                        placeholder="e.g create users" required>
                                    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="guard_name">Guard Name</label>
                                    <input type="text" name="guard_name" class="form-control @error('guard_name') is-invalid @enderror" value="{{ $permission->guard_name }}" id="guard_name" 
                                        placeholder="e.g web" required>
                                    
                                    @error('guard_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <!-- /.card-body -->
                    
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Permission</button>
                            </div>
                        </div>
                        <!-- /.card -->
                    </form>
                </div>
                <div class="col-md-6">
                    <!-- form start -->
                    <form role="form" method="POST" action="{{ route('company.permission.roles.update', ['permission' => $permission]) }}">
                        @method('PUT')
                        @csrf 
                        <!-- general form elements -->
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Edit <strong>{{$permission->name}}</strong> Permission Roles</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="roles">Select Roles to Assign to This Permission</label>
                                    <p><small class="text-muted">*If the roles you want to assign are not in the list, please first create them.</small></p>
                                    <div class="row">
                                        @forelse($roles as $role)
                                            <div class="col-md-4">
                                                <div class="form-group form-check">
                                                    <input type="checkbox" name="roles[]" value="{{$role->id}}" class="form-check-input" id="add-role-{{$role->id}}" 
                                                        {{ ($permission->roles->contains($role->id)) ? ' checked' : '' }}>
                                                    <label class="form-check-label" for="add-role-{{$role->id}}">
                                                        {{$role->name}}
                                                    </label>
                                                </div>
                                            </div>
                                        @empty 
                                            <div class="alert alert-warning" role="alert">
                                                No roles Created Yet, <small>Go to roles to create one</small>
                                            </div>
                                        @endforelse
                                    </div>

                                    @error('roles')
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