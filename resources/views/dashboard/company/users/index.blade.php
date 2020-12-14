@extends('dashboard.company.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Users List</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('company.home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Users</li>
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
                        <div class="row">
                            <div class="col-md-8 col-12 d-flex justify-content-start">
                                <form role="form" method="GET" action="{{route('company.users.index')}}">
                                    <div class="card-tools float-left">
                                        <div class="input-group input-group-md">
                                            <input type="text" name="global_user_search" class="form-control float-right" placeholder="name, phone, email" required>
                        
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div> 
                            <div class="col-md-4 col-12 d-flex justify-content-end">
                                <div class="card-tools">
                                    <company-user-add></company-user-add>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <form role="form" method="GET" action="{{route('company.users.index')}}">

                                    <div class="form-row">
                                        <div class="col-md-1">
                                            <label for="page_size">Page Size</label>
                                            <select name="page_size" class="form-control @error('page_size') is-invalid @enderror" id="page_size">
                                                <option value="10" {{collect(request()->input('page_size'))->contains('10') ? 'selected' : ''}}>10</option>
                                                <option value="25" {{collect(request()->input('page_size'))->contains('25') ? 'selected' : ''}}>25</option>
                                                <option value="50" {{collect(request()->input('page_size'))->contains('50') ? 'selected' : ''}}>50</option>
                                                <option value="100" {{collect(request()->input('page_size'))->contains('100') ? 'selected' : ''}}>100</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="city">Cities</label>
                                            <select name="city" class="form-control @error('city') is-invalid @enderror" id="city">
                                                <option value="">Choose...</option>
                                                @forelse($cities as $city)
                                                    <option value="{{$city->id}}" {{collect(request()->input('city'))->contains($city->id) ? 'selected' : ''}}>
                                                        {{ $city->name }}
                                                    </option>
                                                @empty 
                                                    <div class="alert alert-warning" city="alert">
                                                        No user cities created yet!
                                                    </div>
                                                @endforelse
                                            </select>

                                            @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="user_account_status">Account Status</label>
                                            <select name="user_account_status" class="form-control @error('user_account_status') is-invalid @enderror" id="user_account_status">
                                                <option value="">Choose...</option>
                                                @forelse($user_account_statuses as $status)
                                                    <option value="{{$status->id}}" {{collect(request()->input('user_account_status'))->contains($status->id) ? 'selected' : ''}}>
                                                        {{ $status->name }}
                                                    </option>
                                                @empty 
                                                    <div class="alert alert-warning" role="alert">
                                                        No user account statuses created yet!
                                                    </div>
                                                @endforelse
                                            </select>

                                            @error('user_account_status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label for="role">Roles</label>
                                            <select name="role" class="form-control @error('role') is-invalid @enderror" id="role">
                                                <option value="">Choose...</option>
                                                @forelse($roles as $role)
                                                    <option value="{{$role->id}}" {{collect(request()->input('role'))->contains($role->id) ? 'selected' : ''}}>
                                                        {{ $role->name }}
                                                    </option>
                                                @empty 
                                                    <div class="alert alert-warning" role="alert">
                                                        No user roles created yet!
                                                    </div>
                                                @endforelse
                                            </select>

                                            @error('roles')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-1">

                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>From Date:</label>
                              
                                                <div class="input-group">
                                                  <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                      <i class="fas fa-calendar-alt"></i>
                                                    </span>
                                                  </div>
                                                  <input type="date" name="from_date" value="{{request()->input('from_date')}}" class="form-control" id="from_date">
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>To Date:</label>
                              
                                                <div class="input-group">
                                                  <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                      <i class="fas fa-calendar-alt"></i>
                                                    </span>
                                                  </div>
                                                  <input type="date" name="to_date" value="{{request()->input('to_date')}}" class="form-control" id="to_date">
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                        </div>

                                        
                                        <div class="col-md-2 d-flex justify-content-end mt-4">
                                            <div class="form-group">
                                                <a class="btn btn-outline-secondary mt-2" href="{{route('company.users.index')}}">Reset Filters</a>
                                            </div>
                                        </div>

                                        <div class="col-md-3 mt-4">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-block mt-2">Search</button>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
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
                            <th>City</th>
                            <th>Account Status</th>
                            <th>Roles</th>
                            <th>E-Wallet</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->full_name}}</td>
                                    <td>
                                        {{$user->phone_number}}<br>
                                        <small class="text-muted">{{$user->email}}</small>
                                    </td>
                                    <td class="text-wrap">
                                        @if(!empty($user->userLocation->city->name))
                                            {{$user->userLocation->city->name}}
                                        @else 
                                            <span class="badge badge-warning">No Location</span>
                                        @endif
                                    </td>
                                    
                                    @if(!empty($user->userAccountStatus->name))
                                        <td><span class="badge badge-{{$user->userAccountStatus->color}}">{{$user->userAccountStatus->name}}</span></td>
                                    @else 
                                        <td><span class="badge badge-warning">Null</span></td>
                                    @endif

                                    <td class="text-wrap">
                                        @forelse($user->roles as $role)
                                            <span class="badge badge-primary mb-1">{{$role->name}}</span>
                                        @empty 
                                            <span class="badge badge-warning">No Role Assigned</span>
                                        @endforelse
                                    </td>

                                    @if(!empty($user->eWalletAccount->modified_balance))
                                        <td><h4 class="text-bold">{{$user->eWalletAccount->modified_balance}} <small>ETB</small></h4></td>
                                    @else 
                                        <td><span class="badge badge-warning">No E-Wallet Account</span></td>
                                    @endif

                                    <td>
                                        <small class="text-muted">created:</small> {{$user->created_at->diffForHumans()}}<br>
                                        <small class="text-muted">updated:</small> {{$user->updated_at->diffForHumans() }}
                                    </td>

                                    <td class="project-actions">
                                        <a class="btn btn-info btn-sm" href="{{ route('company.users.edit', ['user' => $user->slug]) }}" role="button">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-user-{{$user->id}}">
                                            <i class="fas fa-trash">
                                            </i>
                                        </button>

                                        <!-- A model window to delete a single permission -->
                                        <div class="modal fade" id="delete-user-{{$user->id}}" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><b class="text-danger">Delete</b> {{$user->full_name}}</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form role="form" method="POST" action="{{ route('company.users.destroy', ['user' => $user]) }}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <div class="modal-body">
                                                        
                                                        <div class="alert alert-danger alert-dismissible text-wrap">
                                                            <h5><i class="icon fas fa-ban"></i> Warning!</h5>
                                                            <small class="text-danger">This action is irreversible!</small><br>

                                                            <p>Are you sure you want to delete the user <strong>{{$user->full_name}}</strong>?</p>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-primary" data-dismiss="modal">No Cancel</button>
                                                        <button type="submit" class="btn btn-danger">Yes Delete</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                            </div>
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </td>
                                </tr>

                            @empty
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-warning">
                                            <h5><i class="icon fas fa-exclamation-triangle"></i> No User Results to Show!</h5>
                                            Adjust your filters to get desired results.
                                        </div>
                                    </div>
                                </div>
                            @endempty

                        </tbody>
                    </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            {{$users->appends(request()->input())->links()}}
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