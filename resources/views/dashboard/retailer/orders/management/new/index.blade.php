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
                    <a class="nav-link active" id="new-tab" href="{{ route('retailer.orders.new.index', ['shop' => $shop]) }}" role="tab" aria-controls="new" aria-selected="false">
                      <i class="fas fa-clipboard-list alert-primary"></i>
                      <span class="badge badge-primary">12</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="in-progress-tab" href="{{ route('retailer.orders.in-progress.index', ['shop' => $shop]) }}" role="tab" aria-controls="in-progress" aria-selected="false">
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
                  <!--new-orders-->
                  <div class="tab-pane fade active show" id="new" role="tabpanel" aria-labelledby="new-tab">

                    <!-- modal ...(for more info)-->
                    <div class="modal fade" id="modal-info">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header bg-info">
                            <h4 class="modal-title">Info Modal</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span></button>
                          </div>
                          <div class="modal-body">
                            <p>Order Details here…</p>
                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-outline-success" data-dismiss="modal">Accept</button>
                            <button type="button" class="btn btn-sm btn-outline-danger">Reject</button>
                          </div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>

                    <h3 class="m-0 text-dark">New Orders</h3>
                    <hr>
                    <!-- New Order Alert -->
                    @forelse($orders as $order)
                      <button type="button" class="btn btn-outline-primary btn-block py-3" data-toggle="modal" data-target="#new-order-{{ $order->id }}">
                        <div class="row align-items-center">

                          <div class="col-9">
                            <div class="row">
                              <div class="col-md-4 d-flex justify-content-start">
                                <p class="mb-1"><i class="fas fa-hashtag pr-2"></i>{{ $order->id }}</p>
                              </div>
    
                              <div class="col-md-4 d-flex justify-content-start">
                                <p class="mb-1"><i class="fas fa-user pr-2"></i> {{ $order->user->first_name }}</p>
                              </div>

                              <div class="col-md-4 d-flex justify-content-start">
                                <small class="mb-1">*Expires: </small>{{ $order->created_at->toTimeString()}}
                              </div>
                            </div>
                          </div>

                          <div class="col-3">
                            <i class="fas fa-info-circle fa-2x"></i>
                          </div>
                        </div>
                      </button>

                      <!-- Modal -->
                      <div class="modal fade" id="new-order-{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="new-order-Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header pb-0" style="border-bottom: #fff">
                              <h5 class="modal-title" id="exampleModalLabel">
                                <div class="row">

                                  <div class="col-12">
                                    <div class="row">
                                      <div class="col-4 d-flex justify-content-start">
                                        <p class="mb-1">#{{$order->id}}</p>
                                      </div>
            
                                      <div class="col-4 d-flex justify-content-start">
                                        <p class="mb-1 text-bold">{{$order->user->first_name}}</p>
                                      </div>
        
                                      <div class="col-4 d-flex justify-content-end">
                                        <small class="mb-1">(*Expires: 11:30pm)</small>
                                      </div>
                                    </div>
                                  </div>

                                </div>

                              </h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>

                            <div class="modal-body">
                              @foreach($order->products as $product)
                              <div class="row">
                                <div class="col-2 text-bold">
                                  x {{$product->pivot->quantity}}
                                </div>
                                <div class="col-6 px-0 text-bold">
                                  {{$product->name}}
                                </div>
                                <div class="col-4 px-0">
                                  ETB {{$product->pivot->amount}} 
                                </div>
                              </div>
                              @endforeach
                              <hr>
                              <div class="row">
                                <div class="col-12">
                                  <p class="d-flex justify-content-end mb-0"> {{ $order->subtotal }} Subtotal: 35.70</p>
                                  <p class="d-flex justify-content-end mb-0">Tax: 2.00</p>
                                  <p class="d-flex justify-content-end mb-0 text-bold">Total: 37.70</p>
                                </div>
                              </div>
                            </div>

                            <div class="modal-footer d-flex justify-content-between">
                                <button href="#" class="btn btn-outline-danger">Reject</button>
                                <button href="#" class="btn btn-primary">Accept Order</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <br>
                    @empty 
                      <p>No new orders for now!</p>
                    @endforelse

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
