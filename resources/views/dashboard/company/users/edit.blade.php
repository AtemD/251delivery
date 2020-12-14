@extends('dashboard.company.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">User Editor</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('company.home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('company.users.index')}}">Users</a></li>
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
                    <!-- form start -->
                    <form role="form" method="POST" action="{{ route('company.users.update', ['user' => $user]) }}">
                        @method('PUT')
                        @csrf 
                        <!-- general form elements -->
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Edit ({{$user->full_name}}) Details</h3>
                            </div>
                            <!-- /.card-header -->

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
                                    <button type="submit" class="btn btn-primary">Update User Details</button>
                                </div>
                        </div>
                        <!-- /.card -->
                    </form>
                </div>

                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- form start -->
                            <form role="form" method="POST" action="{{ route('company.users.account-statuses.update', ['user' => $user]) }}">
                                @method('PUT')
                                @csrf 
                                <!-- general form elements -->
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">Edit User Account Status</h3>
                                    </div>
                                    <!-- /.card-header -->
        
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="user_account_status">Account Status</label>
                                                <select name="user_account_status" class="form-control @error('user_account_status') is-invalid @enderror" id="user_account_status"
                                                    >
                                                    <option value="">...Select Account Status</option>
                                                    @forelse($user_account_statuses as $account_status)
                                                        <option value="{{$account_status->id}}" 
                                                            @if(!empty($user->userAccountStatus->id)) 
                                                            {{ $account_status->id == $user->userAccountStatus->id ? 'selected' : ''}}
                                                            @endif
                                                        >
                                                        {{ $account_status->name }}
                                                        </option>
                                                    @empty 
                                                        <div class="alert alert-warning" role="alert">
                                                            No user account status created, please create one first!
                                                        </div>
                                                    @endforelse
                                                </select>
        
                                                @error('user_account_status')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Update User Account Status</button>
                                        </div>
                                </div>
                                <!-- /.card -->
                            </form>
                        </div>
                        <div class="col-md-12">
                            <!-- form start -->
                            <form role="form" method="POST" action="{{ route('company.e-wallet-accounts.store') }}">
                                @csrf 
                                <!-- general form elements -->
                                <div class="card card-info card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">Edit User E-Wallet Account</h3>
                                    </div>
                                    <!-- /.card-header -->
        
                                        
                                    @if(empty($user->EWalletAccount))
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="alert alert-info alert-dismissible">
                                                    <h5><i class="icon fas fa-info"></i> User has no E-wallet Account!</h5>
                                                    Click on create button to create an account for this user.
                                                </div>

                                                <div class="form-group">
                                                    <input type="hidden" value="{{ $user->slug }}" id="user" name="user" required>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-success">Create E-Wallet Account</button>
                                        </div>
                                    @else
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="text-muted">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p class="text-sm">E-Wallet Account No.:
                                                                <b class="d-block">{{$user->EWalletAccount->number}}</b>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="text-sm">Account Balance:
                                                                <b class="d-block">{{$user->EWalletAccount->modified_balance}} ETB</b>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="text-sm">Account State:
                                                                <b class="d-block">
                                                                    <span class="badge badge-{{$user->EWalletAccount->is_active ? 'primary': 'secondary'}}">
                                                                        {{$user->EWalletAccount->is_active ? 'active': 'inactive'}}
                                                                    </span>
                                                                </b>
                                                            </p>
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <p class="text-sm">Account Status:
                                                                <b class="d-block">
                                                                    @if(!empty($user->EWalletAccount->EWalletAccountStatus))
                                                                        <span class="badge badge-{{$user->EWalletAccount->EWalletAccountStatus->color}}">
                                                                            {{$user->EWalletAccount->EWalletAccountStatus->name}}
                                                                        </span>
                                                                    @else 
                                                                        <span class="badge badge-warning">
                                                                            NULL
                                                                        </span>
                                                                    @endif
                                                                </b>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <a class="btn btn-info" href="{{ route('company.e-wallet-accounts.edit', ['e_wallet_account'=> $user->EWalletAccount->number]) }}">
                                                View E-Wallet Account
                                            </a>
                                        </div>
                                    @endif
                                </div>
                                <!-- /.card -->
                            </form>
                        </div>

                    </div>
                </div>

                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- form start -->
                            <form role="form" method="POST" action="{{ route('company.users.roles.update', ['user' => $user]) }}">
                                @method('PUT')
                                @csrf 
                                <!-- general form elements -->
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">Edit User Roles</h3>
                                    </div>
                                    <!-- /.card-header -->
        
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="roles">Assign Roles</label>
                                                <p>
                                                    <small class="text-muted">Assign Roles This User or first 
                                                        (<a href="{{route('company.roles.index')}}">create a role</a>) to assign to this user
                                                    </small>
                                                </p>
                                                <div class="row">
                                                    @forelse($roles as $role)
                                                        <div class="col-md-4">
                                                            <div class="form-group form-check">
                                                                <input type="checkbox" name="roles[]" value="{{$role->id}}" class="form-check-input" id="add-role-{{$role->id}}" 
                                                                
                                                                    @if(!empty($user->roles)) 
                                                                    {{ ($user->roles->contains($role->id)) ? ' checked' : '' }}
                                                                    @endif
                                                                >
                                                                <label class="form-check-label" for="add-role-{{$role->id}}">{{$role->name}}</label>
                                                            </div>
                                                        </div>
                                                    @empty 
                                                        <div class="alert alert-warning" role="alert">
                                                            No Roles Created Yet, <small>Go to roles to create one</small>
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
                                            <button type="submit" class="btn btn-primary">Update User Roles</button>
                                        </div>
                                </div>
                                <!-- /.card -->
                            </form>
                        </div>
                        <div class="col-md-12">
                            <!-- form start -->
                            <form role="form" method="POST" action="{{ route('company.users.permissions.update', ['user' => $user]) }}">
                                @method('PUT')
                                @csrf 
                                <!-- general form elements -->
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">Edit User Direct Permissions</h3>
                                    </div>
                                    <!-- /.card-header -->
        
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="permissions">Assign Direct Permissions to User</label>
                                            <p>
                                                <small class="text-muted">
                                                    Assign direct permissions to this user or first 
                                                    (<a href="{{route('company.permissions.index')}}">create a permission</a>) to assign to this user
                                                </small>
                                            </p>
                                            <div class="row">
                                                @forelse($permissions as $permission)
                                                    <div class="col-md-6">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" name="permissions[]" value="{{$permission->id}}" class="form-check-input" id="add-permission-{{$permission->id}}" 
                                                            
                                                                @if(!empty($user->permissions)) 
                                                                {{ ($user->permissions->contains($permission->id)) ? ' checked' : '' }}
                                                                @endif
                                                            >
                                                            <label class="form-check-label" for="add-permission-{{$permission->id}}">{{$permission->name}}</label>
                                                        </div>
                                                    </div>
                                                @empty 
                                                    <div class="alert alert-warning" role="alert">
                                                        No Permissions Created Yet, <small>Go to permissions to create one</small>
                                                    </div>
                                                @endforelse
                                            </div>
        
                                            @error('permissions')
                                                <span class="text-danger" role="alert">
                                                    <strong>*{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Update User Direct Permisssions</button>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- /.content -->
    </section>
@endsection