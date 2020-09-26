@extends('dashboard.retailer.layouts.app')

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
                <li class="breadcrumb-item"><a href="{{route('retailer.shops.index', ['shop' => $shop])}}">Home</a></li>
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
                <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title float-left">{{$shop->name}}</h2>
                    
                        <div class="card-tools">
                            <a class="btn btn-info" href="{{ route('retailer.shops.accounts.edit', ['shop'=> $shop]) }}" role="button">
                                <i class="fas fa-pencil-alt"></i> Edit Account
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Availability<br> Status</th>
                                    <th>Account<br> Status</th>
                                    <th>Contact</th>
                                    <th>Image & Logo</th>
                                    <th>Shop<br> Type</th>
                                    <th>Food Preparation<br>Time</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td>
                                            <span class="badge badge-{{$shop->is_available == 1 ? 'primary': 'warning'}}">
                                                {{$shop->is_available == 1 ? 'available': 'unavailable'}}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-{{$shop->shopAccountStatus->color}}">
                                                {{$shop->shopAccountStatus->name}}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="text-muted">
                                                <p class="text-sm">Email
                                                  <b class="d-block">{{$shop->email}}</b>
                                                </p>
                                                <p class="text-sm">Phone
                                                  <b class="d-block">{{$shop->phone_number}}</b>
                                                </p>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-muted text-sm">Image</p>
                                            <img class="img-fluid mb-3" style="height: 80px; width:110px;" src="{{$shop->bannerImagePath}}" alt="Photo">
                                        </td>
                                        <td>{{$shop->shopType->name}}</td>
                                        <td>{{$shop->average_preparation_time}} min</td>
                                        <td class="text-wrap">{{$shop->description}}</td>
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