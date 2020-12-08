@extends('dashboard.company.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Shop Editor</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('company.home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('company.shops.index')}}">shops</a></li>
                    <li class="breadcrumb-item active">Edit</li>
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
                    <!-- form start -->
                    <form role="form" method="POST" action="{{route('company.shops.update', ['shop' => $shop->slug])}}">
                        @method('PUT')
                        @csrf

                        <!-- general form elements -->
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Edit Shop Account Status</h3>
                            </div>
                            <!-- /.card-header --> 
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="shop_account_status">Shop Account Status</label>
                                    <select name="shop_account_status" class="form-control @error('shop_account_status') is-invalid @enderror" id="shop_account_status"
                                        required>
                                        @forelse($shop_account_statuses as $status)
                                            <option value="{{$status->id}}" {{ $shop->shopAccountStatus->id == $status->id ? 'selected' : '' }}>
                                                {{ $status->name }}
                                            </option>
                                        @empty 
                                            <div class="alert alert-warning" role="alert">
                                                No shop account statuses created yet!
                                            </div>
                                        @endforelse
                                    </select>

                                    @error('shop_account_status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Shop Account Status</button>
                            </div>
                        </div>
                    </form>
                    <!-- /.card -->
                </div>
                <div class="col-md-3">
                    ...
                </div>
                <div class="col-md-3">
                    ...
                </div>
            </div>
        </div>
    <!-- /.content -->
    </section>
@endsection