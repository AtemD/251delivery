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
                        <div class="card-tools float-left">
                            <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
        
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                            </div>
                        </div>
                    
                        <div class="card-tools">
                            <a class="btn btn-primary" href="{{ route('company.users.index') }}" role="button">
                                <i class="fas fa-plus xs"></i> Add Wallet Account
                            </a>
                        </div>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Account Number</th>
                                    <th>User</th>
                                    <th>Contact</th>
                                    <th>Balance</th>
                                    <th>State</th>
                                    <th>Account Status</th>
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
                                            {{ $wallet->user->email }}
                                        </td>
                                        <td><h4>{{ $wallet->modified_balance }} <small>{{ $wallet->currency->abbreviation }}</small></h4></td>
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
                                        <td class="project-actions">
                                            <a class="btn btn-primary btn-sm" href="#" role="button">
                                                <i class="fas fa-folder"></i> View
                                            </a>
                                            <a class="btn btn-info btn-sm" href="{{ route('company.e-wallet-accounts.edit', ['e_wallet_account'=> $wallet->number]) }}" role="button">
                                                <i class="fas fa-pencil-alt"></i> Edit
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-e-wallet-account-{{$wallet->id}}">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </td>
                                    </tr>
                                @empty 
                                    <p>No E-Wallet accounts registered yet</p>
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