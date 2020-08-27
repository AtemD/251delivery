@extends('dashboard.buyer.layouts.app')

@section('content')
    <div class="content-wrapper">
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
                    <div class="col-md-4">
                        <!-- About Me Box -->
                        <div class="card card-primary">
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

                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#update-profile">
                                Edit
                            </button>
            
                        </div>
                        <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->


                    <div class="modal fade" id="update-profile" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog update-profile">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Your Profile</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form role="form" method="POST" action="{{ route('buyers.settings.accounts.update', ['buyer' => $buyer]) }}">
                                @method('PUT')
                                @csrf

                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" id="name" name="first_name" value="{{ $buyer->first_name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" id="name" name="last_name" value="{{ $buyer->last_name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="text" class="form-control" id="name" name="phone_number" value="{{ $buyer->phone_number }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <input type="email" class="form-control" id="name" name="email" value="{{ $buyer->email }}" required>
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
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>   
        <!-- /.content -->
    </div>
@endsection