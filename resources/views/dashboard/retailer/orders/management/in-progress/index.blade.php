@extends('dashboard.retailer.layouts.app')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Orders</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Orders</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
        
      <div class="row">
        <!-- /.col -->
        <div class="col-md-6">
            <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs nav-justified" id="custom-tabs-three-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link" id="new-tab" href="{{ route('retailer.orders.new.index', ['shop' => $shop]) }}" role="tab" aria-controls="new" aria-selected="false">
                      <i class="fas fa-clipboard-list alert-primary"></i>
                      <span class="badge badge-primary">12</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" id="in-progress-tab" href="{{ route('retailer.orders.in-progress.index', ['shop' => $shop]) }}" role="tab" aria-controls="in-progress" aria-selected="false">
                      <i class="fas fa-spinner alert-warning"></i>
                      <span class="badge badge-warning">14</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="ready-tab" href="{{ route('retailer.orders.ready.index', ['shop' => $shop]) }}" role="tab" aria-controls="ready" aria-selected="true">
                      <i class="fas fa-check-square alert-success"></i>
                      <span class="badge badge-success">9</span>
                    </a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">

                  <!--in-progress-->
                  <div class="tab-pane fade active show" id="in-progress" role="tabpanel" aria-labelledby="in-progress-tab">
                    <h3 class="m-0 text-dark">In Progress Orders</h3>
                    <hr>
                    <div class="alert alert-warning">
                      <div class="row">
                        <div class="col-md-6">
                          <h5><i class="icon fas fa-hashtag"></i> 
                            RT3456
                            <button href="#" class="btn btn-sm btn-info">
                              <i class="icon fas fa-eye"></i>
                            </button>
                          </h5>
                        </div>
                        <div class="col-md-6">
                          <i class="icon fas fa-user"></i>John
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <i class="icon fas fa-phone"></i>0980232745
                        </div>
                        <div class="col-md-6">
                          <i class="icon fas fa-list-ul"></i>Beyanat(x2), Pasta(x1)
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-7 col-md-7">
                          <button href="#" class="btn btn-sm btn-block btn-outline-primary">Ready</button>
                        </div>
                        <div class="col-5 col-md-5">
                          <button href="#" class="btn btn-sm btn-block btn-outline-danger">Reject</button>
                        </div>
                      </div>
                    </div>
                    <div class="alert alert-warning">
                      <div class="row">
                        <div class="col-md-6">
                          <h5><i class="icon fas fa-hashtag"></i> 
                            RT3456
                            <button href="#" class="btn btn-sm btn-info">
                              <i class="icon fas fa-eye"></i>
                            </button>
                          </h5>
                        </div>
                        <div class="col-md-6">
                          <i class="icon fas fa-user"></i>John
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <i class="icon fas fa-phone"></i>0980232745
                        </div>
                        <div class="col-md-6">
                          <i class="icon fas fa-list-ul"></i>Beyanat(x2), Pasta(x1)
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-7 col-md-7">
                          <button href="#" class="btn btn-sm btn-block btn-outline-primary">Ready</button>
                        </div>
                        <div class="col-5 col-md-5">
                          <button href="#" class="btn btn-sm btn-block btn-outline-danger">Reject</button>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
              <!-- /.card -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
            <!-- Order History Section -->
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title"><i class="fas fa-history"></i> Todays Sales History</h3>
                  <a href="javascript:void(0);">View Report</a>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <!-- ./col -->
                  <div class="col-lg-6 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                      <div class="inner">
                        <h3>53</h3>

                        <p>Completed Orders</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                      </div>
                      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-6 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                      <div class="inner">
                        <h3>4</h3>

                        <p>Rejected Orders</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                      </div>
                      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                </div>
              </div>
            </div>
        </div>
      </div>

    </div>
  </div>
  <!-- /.content -->
@endsection
