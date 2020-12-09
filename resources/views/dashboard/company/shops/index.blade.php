@extends('dashboard.company.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Shops List</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('company.home')}}">Home</a></li>
                <li class="breadcrumb-item active">Shops</li>
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
                                <form role="form" method="GET" action="{{route('company.shops.index')}}">
                                    <div class="card-tools float-left">
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="text" name="global_shop_search" class="form-control float-right" placeholder="Search name">
                        
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            
                                <div class="card-tools">
                                    <button href="#add-shop" class="btn btn-primary" data-toggle="modal" data-target="#add-shop">
                                        <i class="fas fa-store-alt"></i>
                                        <i class="fas fa-plus xs"></i>
                                        Add Shop
                                    </button>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                                <div class="col-md-12">
                                    <form role="form" method="GET" action="{{route('company.shops.index')}}">
                                        {{-- @method('PUT')
                                        @csrf --}}
                                        <div class="form-row">
                                            <div class="col-md-2">
                                                <label for="page_size">Page Size</label>
                                                <select name="page_size" class="form-control @error('page_size') is-invalid @enderror" id="page_size">
                                                    <option value="10" {{collect(request()->input('page_size'))->contains('10') ? 'selected' : ''}}>10</option>
                                                    <option value="25" {{collect(request()->input('page_size'))->contains('25') ? 'selected' : ''}}>25</option>
                                                    <option value="50" {{collect(request()->input('page_size'))->contains('50') ? 'selected' : ''}}>50</option>
                                                    <option value="100" {{collect(request()->input('page_size'))->contains('100') ? 'selected' : ''}}>100</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="shop_account_status">Account Status</label>
                                                <select name="shop_account_status" class="form-control @error('shop_account_status') is-invalid @enderror" id="shop_account_status">
                                                    <option value="">Choose...</option>
                                                    @forelse($shop_account_statuses as $status)
                                                        <option value="{{$status->id}}" {{collect(request()->input('shop_account_status'))->contains($status->id) ? 'selected' : ''}}>
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
                                            <div class="col-md-2">
                                                <label for="city">Cities</label>
                                                <select name="city" class="form-control @error('city') is-invalid @enderror" id="city">
                                                    <option value="">Choose...</option>
                                                    @forelse($cities as $city)
                                                        <option value="{{$city->id}}" {{collect(request()->input('city'))->contains($city->id) ? 'selected' : ''}}>
                                                            {{ $city->name }}
                                                        </option>
                                                    @empty 
                                                        <div class="alert alert-warning" role="alert">
                                                            No cities created yet!
                                                        </div>
                                                    @endforelse
                                                </select>

                                                @error('city')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-2">
                                                <label for="shop_type">Shop Type</label>
                                                <select name="shop_type" class="form-control @error('shop_type') is-invalid @enderror" id="shop_type">
                                                    <option value="">Choose...</option>
                                                    @forelse($shop_types as $shop_type)
                                                        <option value="{{$shop_type->id}}" {{collect(request()->input('shop_type'))->contains($shop_type->id) ? 'selected' : ''}}>
                                                            {{ $shop_type->name }}
                                                        </option>
                                                    @empty 
                                                        <div class="alert alert-warning" role="alert">
                                                            No shop types created yet!
                                                        </div>
                                                    @endforelse
                                                </select>

                                                @error('shop_type')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-2">
                                                <label for="is_available">Availability</label>
                                                <select name="is_available" class="form-control @error('is_available') is-invalid @enderror" id="is_available">
                                                    <option value="">Choose...</option>
                                                    <option value="available" {{collect(request()->input('is_available'))->contains('available') ? 'selected' : ''}}>available</option>
                                                    <option value="unavailable" {{collect(request()->input('is_available'))->contains('unavailable') ? 'selected' : ''}}>Unavailable</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2 mt-4">
                                                <button type="submit" class="btn btn-primary btn-block mt-2">Search</button>
                                            </div>
                                        
                                        </div>
                                        {{-- <div class="form-row d-flex justify-content-end">
                                            <div class="col-md-2 mt-1">
                                                <button type="submit" class="btn btn-primary btn-block">Search</button>
                                            </div>
                                        </div> --}}
                                        
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
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Type</th>
                                <th>Account Status</th>
                                <th>Availablity</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($shops as $shop)
                                <tr>
                                    <td>{{$shop->id}}</td>
                                    <td>{{$shop->name}}</td>
                                    <td>
                                        {{$shop->phone_number}}<br>
                                        {{$shop->email}}
                                    </td>
                                    <td>{{$shop->shopType->name}}</td>
                                    <td><span class="badge badge-{{$shop->shopAccountStatus->color}}">{{$shop->shopAccountStatus->name}}</span></td>
                                    <td><span class="badge badge-{{$shop->is_available == 1 ? 'primary': 'secondary'}}">{{$shop->is_available == 1 ? 'Available': 'Unavailable'}}</span></td>
                                    <td class="project-actions">
                                        <a class="btn btn-info btn-sm" href="{{ route('company.shops.edit', ['shop' => $shop->slug]) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-shop-{{$shop->id}}">
                                            <i class="fas fa-trash">
                                            </i>
                                        </button>

                                    </td>
                                </tr>

                            @empty
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-warning">
                                            <h5><i class="icon fas fa-exclamation-triangle"></i> No Shop Results To Show!</h5>
                                            Try adjust your search filters.
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
                            {{$shops->appends(request()->input())->links()}}
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