@extends('dashboard.company.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">E-Wallet Accounts</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('company.home')}}">Home</a></li>
                    <li class="breadcrumb-item active">E-Wallet Accounts</li>
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
                            <div class="col-md-12 d-flex justify-content-between">
                                <form role="form" method="GET" action="{{route('company.e-wallet-accounts.index')}}">
                                    <div class="card-tools float-left">
                                        <div class="input-group input-group-md">
                                            <input type="text" name="global_e_wallet_search" value="{{request()->input('global_e_wallet_search')}}" class="form-control float-right" placeholder="search account number">
                        
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            
                                <div class="card-tools">
                                    <a href="{{route('company.users.index')}}" class="btn btn-primary">
                                        <i class="fas fa-order-plus xs"></i>
                                        Add E-Wallet Account
                                    </a>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <form role="form" method="GET" action="{{route('company.e-wallet-accounts.index')}}">
                                    <div class="form-row mb-1">
                                        <div class="col-md-1">
                                            <label for="page_size">Page Size</label>
                                            <select name="page_size" class="form-control @error('page_size') is-invalid @enderror" id="page_size">
                                                <option value="10" {{collect(request()->input('page_size'))->contains('10') ? 'selected' : ''}}>10</option>
                                                <option value="25" {{collect(request()->input('page_size'))->contains('25') ? 'selected' : ''}}>25</option>
                                                <option value="50" {{collect(request()->input('page_size'))->contains('50') ? 'selected' : ''}}>50</option>
                                                <option value="100" {{collect(request()->input('page_size'))->contains('100') ? 'selected' : ''}}>100</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="account_status">Account Status</label>
                                            <select name="account_status" class="form-control @error('account_status') is-invalid @enderror" id="account_status">
                                                <option value="">Select...</option>
                                                @forelse($e_wallet_account_statuses as $status)
                                                    <option value="{{$status->id}}" {{collect(request()->input('account_status'))->contains($status->id) ? 'selected' : ''}}>
                                                        {{ $status->name }}
                                                    </option>
                                                @empty 
                                                    <div class="alert alert-warning" role="alert">
                                                        No order statuses created yet!
                                                    </div>
                                                @endforelse
                                            </select>

                                            @error('account_status')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="is_active">Active State</label>
                                            <select name="is_active" class="form-control @error('is_active') is-invalid @enderror" id="is_active">
                                                <option value="">Choose...</option>
                                                <option value="active" {{collect(request()->input('is_active'))->contains('active') ? 'selected' : ''}}>Active</option>
                                                <option value="inactive" {{collect(request()->input('is_active'))->contains('inactive') ? 'selected' : ''}}>Inactive</option>
                                            </select>
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
                                    
                                    </div> 
                                    <div class="form-row">
                                        <div class="col-md-6">

                                        </div>
                                        
                                        <div class="col-md-3 d-flex justify-content-end">
                                            <div class="form-group">
                                                <a class="btn btn-outline-secondary mt-2" href="{{route('company.e-wallet-accounts.index')}}">Reset Filters</a>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
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
                                    <th>Number</th>
                                    <th>User</th>
                                    <th>Contact</th>
                                    <th>Balance</th>
                                    <th>State</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($e_wallet_accounts as $wallet)
                                    <tr>
                                        <td>{{ $wallet->number }}</td>
                                        <td>{{ $wallet->user->full_name }}</td>
                                        <td>
                                            {{ $wallet->user->phone_number }}<br>
                                            <small class="text-muted">
                                                {{ $wallet->user->email }}
                                            </small>
                                        </td>
                                        <td><h4>{{ $wallet->modified_balance }} <small class="text-muted">{{ $wallet->currency->abbreviation }}</small></h4></td>
                                        <td>
                                            <span class="badge badge-{{$wallet->is_active == 1 ? 'primary': 'warning'}}">
                                                {{$wallet->is_active == 1 ? 'active': 'inactive'}}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-{{$wallet->eWalletAccountStatus->color}}">
                                                {{ $wallet->eWalletAccountStatus->name }}
                                            </span>
                                        </td>
                                        <td>
                                            <small class="text-muted">created:</small> {{$wallet->created_at->diffForHumans()}}<br>
                                            <small class="text-muted">updated:</small> {{$wallet->updated_at->diffForHumans() }}
                                        </td>
                                        <td class="project-actions">
                                            <a class="btn btn-primary btn-sm" href="#" role="button">
                                                <i class="fas fa-folder"></i>
                                            </a>
                                            <a class="btn btn-info btn-sm" href="{{ route('company.e-wallet-accounts.edit', ['e_wallet_account'=> $wallet->number]) }}" role="button">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-e-wallet-account-{{$wallet->id}}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-warning">
                                                <h5><i class="icon fas fa-exclamation-triangle"></i> No E-Wallet Accounts To Show!</h5>
                                                Try to adjust your search filters.
                                            </div>
                                        </div>
                                    </div>
                                @endforelse 
                            </tbody>
                        </table>
                    </div>
                     <!-- /.card-body -->
                     <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            {{$e_wallet_accounts->links()}}
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