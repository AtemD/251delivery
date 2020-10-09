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
                <div class="col-md-4">
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
                                        <p><small class="text-muted">Assign Roles This User or first (<a href="#">create a role</a>) to assign to this user</small></p>
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
            </div>
        </div>
    <!-- /.content -->
    </section>
@endsection