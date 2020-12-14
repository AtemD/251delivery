@extends('dashboard.company.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">E-Wallet Account Editor</h1>
                <h5 class="text-secondary">Account No: {{ $e_wallet_account->number }}</h5>
                <h4 class="text-success">Account Balance: {{ $e_wallet_account->modified_balance }} ETB</h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('company.home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('company.e-wallet-accounts.index')}}">E-Wallet Accounts</a></li>
                    <li class="breadcrumb-item active">Edit E-Wallet</li>
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
                    <!-- About Me Box -->
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Account Summary</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-dot-circle mr-1"></i> User Full Name</strong>
                            <p class="text-muted">{{$e_wallet_account->user->first_name}} {{$e_wallet_account->user->last_name}}</p>
                            <hr>

                            <strong><i class="fas fa-dot-circle mr-1"></i> Account Number</strong>
                            <p class="text-muted">{{$e_wallet_account->number}}</p>
                            <hr>

                            <strong><i class="fas fa-dot-circle mr-1"></i> Account Balance</strong>
                            <p class="text-muted">{{$e_wallet_account->modified_balance}} ETB</p>
                            <hr>

                            <strong><i class="fas fa-dot-circle mr-1"></i> Account Status</strong>
                            <p class="text-muted">{{$e_wallet_account->eWalletAccountStatus->name}}</p>
                            <hr>

                            <strong><i class="fas fa-dot-circle mr-1"></i> Created At</strong>
                            <p class="text-muted">{{$e_wallet_account->created_at->diffForHumans()}}</p>
                            <hr>
    
                            {{-- <a href="{{ route('buyers.accounts.edit') }}" class="btn btn-primary btn-block">
                                <i class="fas fa-pen xs"></i>
                                Edit
                            </a> --}}
    
                        </div>
                        <!-- /.card-body -->
                    </div>
                        <!-- /.card -->
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                             <!-- form start -->
                            <form role="form" method="POST" action="{{ route('company.e-wallet-accounts.deposits.update', ['e_wallet_account' => $e_wallet_account->number]) }}">
                                @method('PUT')
                                @csrf

                                <!-- general form elements -->
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">E-Wallet Deposit</h3>
                                    </div>
                                    <!-- /.card-header --> 
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="deposit_amount">Deposit Amount</label>
                                            <input type="text" name="deposit_amount" class="form-control @error('deposit_amount') is-invalid @enderror" placeholder="amount to deposit in ETB" id="deposit_amount" 
                                                required>
                                            
                                            @error('deposit_amount')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Deposit to E-Wallet</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12">
                             <!-- form start -->
                            <form role="form" method="POST" action="{{ route('company.e-wallet-accounts.withdrawals.update', ['e_wallet_account' => $e_wallet_account->number]) }}">
                                @method('PUT')
                                @csrf

                                <!-- general form elements -->
                                <div class="card card-danger">
                                    <div class="card-header">
                                        <h3 class="card-title">E-Wallet Withdrawal</h3>
                        
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <!-- /.card-tools -->
                                    </div>
                                    <!-- /.card-header --> 
                                    <div class="card-body" style="display: block;">
                                        <div class="form-group">
                                            <label for="withdraw_amount">Withdraw Amount</label>
                                            <input type="text" name="withdraw_amount" class="form-control @error('withdraw_amount') is-invalid @enderror" placeholder="amount to withdraw in ETB" id="withdraw_amount" 
                                                required>
                                            
                                            @error('withdraw_amount')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-danger">Withraw from E-Wallet</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <form role="form" method="POST" action="{{ route('company.e-wallet-account-statuses.update', ['e_wallet_account' => $e_wallet_account->number])}}">
                                @method('PUT')
                                @csrf
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">Edit E-Wallet Account Status</h3>
                                    </div>
                                    <div class="card-body">
        
                                        <div class="form-group">
                                            <label for="e_wallet_account_status">E-Wallet Account Status</label>
                                            <select name="e_wallet_account_status" class="form-control @error('e_wallet_account_status') is-invalid @enderror" id="e_wallet_account_status"
                                                required>
                                                @forelse($e_wallet_account_statuses as $status)
                                                    <option value="{{$status->id}}" {{ $status->id == $e_wallet_account->eWalletAccountStatus->id ? 'selected' : '' }}>
                                                        {{ $status->name }}
                                                    </option>
                                                @empty 
                                                    <div class="alert alert-warning" role="alert">
                                                        No E-Wallet Account Statuses Created Yet!
                                                    </div>
                                                @endforelse
                                            </select>
        
                                            @error('e_wallet_account_status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Update E-Wallet Account Status</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12">
                            <form role="form" method="POST" action="{{ route('company.e-wallet-accounts.update', ['e_wallet_account' => $e_wallet_account->number])}}">
                                @method('PUT')
                                @csrf
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">Edit E-Wallet Account State</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Active State</label>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" 
                                                    {{$e_wallet_account->is_active === 1 ? 'checked' : ''}}>
                                                <label class="custom-control-label" for="is_active"><small class="text-muted">(active/inactive)</small></label>
                                            </div>
        
                                            @error('is_active')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Update E-Wallet Active State</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- /.content -->
    </section>
@endsection