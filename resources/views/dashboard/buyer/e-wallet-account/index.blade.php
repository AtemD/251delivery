@extends('dashboard.buyer.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">E-Wallet Account</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('buyers.home')}}">Home</a></li>
                <li class="breadcrumb-item active">E-Wallet Account</li>
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
                        <h2 class="card-title float-left">{{auth()->user()->full_name}}</h2>
                    
                        <div class="card-tools">
                            {{-- <a class="btn btn-info" href="{{ route('buyer.shops.accounts.edit', ['shop'=> $shop]) }}" role="button">
                                <i class="fas fa-pencil-alt"></i> Edit Account
                            </a> --}}
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Wallet Number</th>
                                    <th>Balance</th>
                                    <th>State</th>
                                    <th>Account Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $e_wallet_account->number }}</td>
                                    <td><h4>{{ $e_wallet_account->modified_balance }} <small>{{ $e_wallet_account->currency->abbreviation }}</small></h4></td>
                                    <td>
                                        <span class="badge badge-{{$e_wallet_account->is_active == 1 ? 'primary': 'warning'}}">
                                            {{$e_wallet_account->is_active == 1 ? 'active': 'inactive'}}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-{{$e_wallet_account->eWalletAccountStatus->color}}">
                                            {{ $e_wallet_account->eWalletAccountStatus->name }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    
                </div>
                <!-- /.card -->
                </div>
            </div>
        </div>
    <!-- /.content -->
    </section>
@endsection 