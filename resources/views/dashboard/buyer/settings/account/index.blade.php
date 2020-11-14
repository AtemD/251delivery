@extends('dashboard.buyer.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Account</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('buyers.home')}}">Home</a></li>
                <li class="breadcrumb-item">Settings</li>
                <li class="breadcrumb-item active">Account</li>
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
                <div class="col-md-12">
                    <!-- About Me Box -->
                    <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">About Me</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong><i class="fas fa-signature mr-1"></i> First Name</strong>
                        <p class="text-muted">{{$buyer->first_name}}</p>
                        <hr>
        
                        <strong><i class="fas fa-signature mr-1"></i> Last Name</strong>
                        <p class="text-muted">{{$buyer->last_name}}</p>
                        <hr>

                        <strong><i class="fas fa-phone mr-1"></i> Phone Number</strong>
                        <p class="text-muted">{{$buyer->phone_number}}</p>
                        <hr>

                        <strong><i class="fas fa-envelope-square mr-1"></i> Email</strong>
                        <p class="text-muted">{{$buyer->email}}</p>
                        <hr>

                        <strong><i class="fas fa-user-circle mr-1"></i> Account Status</strong>
                        <p class="text-muted">Verified</p>
                        <hr>
                        
                        <a href="{{ route('buyers.accounts.edit') }}" class="btn btn-primary btn-block">
                            <i class="fas fa-pen xs"></i>
                            Edit
                        </a>

                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>   
    <!-- /.content -->
@endsection