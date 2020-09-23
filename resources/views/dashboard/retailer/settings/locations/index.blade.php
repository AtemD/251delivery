@extends('dashboard.retailer.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Location</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('retailer.shops.index', ['shop' => $shop])}}">Home</a></li>
                <li class="breadcrumb-item">Settings</li>
                <li class="breadcrumb-item active">Location</li>
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
                            <a class="btn btn-info" href="{{ route('retailer.locations.edit', ['shop'=> $shop]) }}" role="button">
                                <i class="fas fa-pencil-alt"></i> Edit Location
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>City</th>
                                    <th>Postal</th>
                                    <th>Street</th>
                                    <th>Building No.</th>
                                    <th>Specific Info.</th>
                                    <th>Address</th>
                                    <th>Street</th>
                                    <th>Lat/Long</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$shop->shopLocation->city->name}}</td>
                                    <td>{{$shop->shopLocation->postal_code}}</td>
                                    <td>{{$shop->shopLocation->street}}</td>
                                    <td>{{$shop->shopLocation->building}}</td>
                                    <td class="text-wrap">{{$shop->shopLocation->specific_information}}</td>
                                    <td class="text-wrap">{{$shop->shopLocation->address}}</td>
                                    <td>{{$shop->shopLocation->street}}</td>
                                    <td>
                                        lat: {{$shop->shopLocation->latitude}}<br>
                                        long: {{$shop->shopLocation->longitude}}
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