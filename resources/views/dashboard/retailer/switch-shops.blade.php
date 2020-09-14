@extends('dashboard.retailer.layouts.shop')

@section('content')
<div class="content-wrapper">
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
      <div class="card-body pb-0">
        <div class="row d-flex align-items-stretch">
          @foreach($shops as $shop)
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
          @endforeach
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
</div>
@endsection

