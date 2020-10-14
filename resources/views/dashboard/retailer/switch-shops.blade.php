@extends('dashboard.retailer.layouts.shop')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Select a Shop to Manage</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Shops</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card card-solid">
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
              {{-- <button href="#add-shop" class="btn btn-primary" data-toggle="modal" data-target="#add-shop">
                  <i class="fas fa-store-alt"></i>
                  <i class="fas fa-plus xs"></i>
                  Add Shop
              </button> --}}
              <retailer-shop-add :shoptypes="{{$shop_types}}"></retailer-shop-add>
          </div>
      </div>

      <div class="card-body pb-0">
        <div class="row d-flex align-items-stretch">
          @forelse($shops as $shop)
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
                  Piasa
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>{{$shop->name}}</b></h2>
                    </div>
                    <div class="col-5 text-center">
                      <img src="{{$shop->bannerImagePath}}" alt="" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <a href="{{ route('retailer.shops.index', ['shop' => $shop]) }}" class="btn btn-sm btn-primary">
                      <i class="fas fa-user"></i> Manage
                    </a>
                  </div>
                </div>
              </div>
            </div>
          @empty 
            <div class="col-12 col-sm-6 col-md-12">
              <div class="alert alert-warning">
                <h5><i class="icon fas fa-exclamation-triangle"></i> You Haven't Registered Any Shop Yet!</h5>
                  Please register your shop by cliking the "Add Shop" button above.
              </div>
          </div>
          @endforelse
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        {{$shops->links()}}
      </div>
      <!-- /.card-footer -->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
@endsection

