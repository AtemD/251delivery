@extends('dashboard.retailer.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit User</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('retailer.shops.index', ['shop' => $shop])}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('retailer.users.index', ['shop' => $shop, 'user' => $user])}}">Users</a></li>
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
                <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit ({{$user->full_name}}) Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{ route('retailer.users.update', ['shop' => $shop, 'user' => $user]) }}">
                            @method('PUT')
                            @csrf 

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" value="{{ $user->first_name }}" id="first_name" placeholder="first name of user" name="first_name" required>
                                    
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" value="{{ $user->last_name }}" id="last_name" placeholder="last name of user" name="last_name" required>
                                    
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror" value="{{ $user->phone_number }}" id="phone_number" placeholder="phone number of user" name="phone_number" required>
                                    
                                    @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}" name="email" required autocomplete="email">
                                    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <!-- /.card-body -->
                    
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>

                <!-- 
                    This check is important,
                    Retailers cannot edit their permissions (since they have all their necessary permissions by default),
                    and users assigned by the retailer cannot edit their permissions. 
                    This means no user can edit their own permissions,
                    just show them a list of their permissions
                -->
                @if(Auth::user()->id == $user->id)
                    <div class="col-md-8">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Your Permissions</h3>
                            </div>
                            <div class="card-body">
                                
                                <div class="form-group">
                                    <label for="permissions">Permissions</label>
                                    <div class="row">
                                        @forelse($retailer_role->permissions as $permission)
                                            <div class="col-md-4">
                                                <div class="form-group form-check">
                                                    <input type="checkbox" name="permissions[]" value="{{$permission->id}}" class="form-check-input" id="add-permission-{{$permission->id}}" 
                                                    {{ ( $user_permissions->contains($permission->id) ) ? ' checked' : '' }} disabled>

                                                    <label class="form-check-label" for="add-permission-{{$permission->id}}">{{$permission->name}}</label>
                                                </div>
                                            </div>
                                        @empty 
                                            <div class="alert alert-warning" role="alert">
                                                No permissions to show, contact admin for help.
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
                                Missing any permissions? Please contact whoever gave you the permissions.
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-8">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit ({{$user->full_name}}) Permissions</h3>
                            </div>
                            <form role="form" method="POST" action="{{ route('retailer.shops.users.permissions.update', ['shop' => $shop, 'user' => $user]) }}">
                                @method('PUT')
                                @csrf 

                                <div class="card-body">
                                    
                                    <div class="form-group">
                                        @error('permissions')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            <br>
                                        @enderror

                                        <label for="permissions">Permissions</label>
                                        <p><small class="text-muted">Carefully select permissions to assign to {{$user->full_name}}</small></p>
                                        <p><small class="text-muted">*By default all shop users assigned to the permission 'access retailer dashboard'</small></p>
                                        <div class="row">
                                            @forelse($retailer_role->permissions as $permission)
                                                <div class="col-md-4">
                                                    <div class="form-group form-check">
                                                        <input type="checkbox" name="permissions[]" value="{{$permission->id}}" class="form-check-input" id="add-permission-{{$permission->id}}" 
                                                        {{ ( $user_permissions->contains($permission->id) ) ? ' checked' : '' }} 
                                                        {{ (App\Models\Permission::ACCESS_RETAILER_DASHBOARD == $permission->name) ? 'disabled' : '' }}>

                                                        <label class="form-check-label" for="add-permission-{{$permission->id}}">{{$permission->name}}</label>
                                                    </div>
                                                </div>
                                            @empty 
                                                <div class="alert alert-warning" role="alert">
                                                    No permissions to show, contact admin for help.
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>

                                </div>
                                <!-- /.card-body -->
                        
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update User Permissions</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    <!-- /.content -->
    </section>
@endsection