@extends('dashboard.company.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Retailers List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('company.home')}}">Home</a></li>
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item active">Retailers</li>
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
                                <button href="#add-retailer" class="btn btn-primary" data-toggle="modal" data-target="#add-retailer">
                                    <i class="fas fa-retailer-plus xs"></i>
                                    Add Retailer
                                </button>
                                
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Contact</th>
                                <th>Status</th>
                                <th>Roles</th>
                                <th>Shops</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($retailers as $retailer)
                                    <tr>
                                        <td>{{$retailer->id}}</td>
                                        <td>{{$retailer->full_name}}</td>
                                        <td>
                                            <p><small>Phone: </small>{{$retailer->phone_number}}</p>
                                            <p><small>Email: </small>{{$retailer->email}}</p>
                                        </td>
                                        
                                        @if(!empty($retailer->userAccountStatus->name))
                                            <td><span class="badge badge-{{$retailer->userAccountStatus->color}}">{{$retailer->userAccountStatus->name}}</span></td>
                                        @else 
                                            <td><span class="badge badge-warning">Null</span></td>
                                        @endif

                                        <td>
                                            @forelse($retailer->roles as $role)
                                                <span class="badge badge-primary">{{$role->name}}</span><br>
                                            @empty 
                                                <span class="badge badge-warning">No Role Assigned</span>
                                            @endforelse
                                        </td>

                                        <td>
                                            <ul>
                                                @forelse($retailer->shops as $shop)
                                                    <li>{{$shop->name}}</li>
                                                @empty 
                                                    <span class="badge badge-warning">Retailer has no registered shop</span>
                                                @endforelse
                                            </ul>
                                        </td>

                                        <td class="project-actions">
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit-retailer-{{$retailer->id}}">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-retailer-{{$retailer->id}}">
                                                <i class="fas fa-trash">
                                                </i>
                                            </button>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="edit-retailer-{{$retailer->id}}" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable edit-retailer-{{$retailer->id}}">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><b>Edit</b> {{$retailer->full_name}}</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <form role="form" method="POST" action="{{ route('company.retailers.update', ['retailer' => $retailer->id]) }}">
                                                @method('PUT')
                                                @csrf

                                                <div class="modal-body">
                                                    <div class="form-group{{ $errors->has('first_name') ? ' is-invalid' : '' }}">
                                                        <label for="first_name">First Name</label>
                                                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $retailer->first_name }}" required>
                                                    </div>
                                                    <div class="form-group{{ $errors->has('last') ? ' is-invalid' : '' }}">
                                                        <label for="last_name">Last Name</label>
                                                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $retailer->last_name }}" required>
                                                    </div>
                                                    <div class="form-group{{ $errors->has('phone_number') ? ' is-invalid' : '' }}">
                                                        <label for="phone_number">Phone No.</label>
                                                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $retailer->phone_number }}" required>
                                                    </div>
                                                    <div class="form-group{{ $errors->has('email') ? ' is-invalid' : '' }}">
                                                        <label for="email">Email</label>
                                                        <input id="email" type="email" class="form-control" name="email" value="{{ $retailer->email }}" required autocomplete="email">
                                                    </div>
                                                    <div class="form-group{{ $errors->has('user_account_status_id') ? ' is-invalid' : '' }}">
                                                        <label for="user_account_status_id">Account Status</label>
                                                        <select class="form-control" id="user_account_status_id" name="user_account_status_id" value="{{ old('user_account_status_id') }}">
                                                            <option value="">Choose status</option>
                                                            @foreach($user_account_statuses as $status)
                                                              <option value="{{ $status->id }}" {{ ($retailer->user_account_status_id == $status->id) ? 'selected' : ' '}}>
                                                                {{ $status->name }}
                                                              </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group{{ $errors->has('roles') ? ' is-invalid' : '' }}">
                                                        <label for="roles">Roles</label>
                                                        <div class="row">
                                                            @forelse($roles as $role)
                                                                <div class="col-md-4">
                                                                    <div class="form-group form-check">
                                                                        <input type="checkbox" name="roles[]" value="{{$role->id}}" class="form-check-input" id="update-role-{{$role->id}}"
                                                                        {{$retailer->roles->contains($role->id) ? 'checked' : ''}}>
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

                                    <div class="modal fade" id="delete-retailer-{{$retailer->id}}" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog delete-retailer-{{$retailer->id}}">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Delete {{$retailer->full_name}}</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <form role="form" method="POST" action="{{ route('company.retailers.destroy', ['retailer' => $retailer->id]) }}">
                                                @method('DELETE')
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="alert alert-danger" role="alert">
                                                        Are you sure you want to delete the retailer: <b>{{$retailer->full_name}}</b>
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
                                                <h5><i class="icon fas fa-warning"></i> No retailer Registered Yet!</h5>
                                                Register at least one retailer.
                                            </div>
                                        </div>
                                    </div>
                                @endempty

                                <div class="modal fade" id="add-retailer" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog add-retailer modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add New Retailer</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        
                                        <form role="form" method="POST" action="{{ route('company.retailers.store') }}">
                                            @csrf

                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="first_name">First Name</label>
                                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                                                    @if ($errors->has('first_name'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('first_name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="last_name">Last Name</label>
                                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                                                    @if ($errors->has('last_name'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('last_name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone_number">Phone No.</label>
                                                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required>
                                                    @if ($errors->has('phone_number'))
                                                        <div class="invalid-feedback">
                                                            <strong>{{ $errors->first('phone_number') }}</strong>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                                    @if ($errors->has('email'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="user_account_status_id">Account Status</label>
                                                    <select class="form-control @error('user_account_status_id') is-invalid @enderror" id="user_account_status_id" name="user_account_status_id" value="{{ old('user_account_status_id') }}">
                                                        <option value="">Choose status</option>
                                                        @foreach($user_account_statuses as $status)
                                                          <option value="{{ $status->id }}">
                                                            {{ $status->name }}
                                                          </option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('user_account_status_id'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('user_account_status_id') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group{{ $errors->has('roles') ? ' is-invalid' : '' }}">
                                                    <label for="roles">Roles</label>
                                                    <div class="row">
                                                        @forelse($roles as $role)
                                                            <div class="col-md-4">
                                                                <div class="form-group form-check">
                                                                    <input type="checkbox" name="roles[]" value="{{$role->id}}" class="form-check-input" id="add-role-{{$role->id}}"
                                                                    {{ $role->name == 'retailer' ? 'checked': ''}}>
                                                                    <label class="form-check-label" for="add-role-{{$role->id}}">{{$role->name}}</label>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('roles'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('roles') }}</strong>
                                                                </span>
                                                            @endif
                                                        @empty 
                                                            <div class="alert alert-warning" role="alert">
                                                                No roles to show
                                                            </div>
                                                        @endforelse
                                                    </div>
                                                </div>
                                                <div class="form-group{{ $errors->has('password') ? ' is-invalid' : '' }}">
                                                    <label for="email">Password</label>
                                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                                    @if ($errors->has('password'))
                                                        <div class="invalid-feedback">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Confirm Password</label>
                                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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
                                {{$retailers->links()}}
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