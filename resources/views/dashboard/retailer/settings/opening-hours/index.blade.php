@extends('dashboard.retailer.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Opening Hours</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('retailer.shops.index', ['shop' => $shop])}}">Home</a></li>
                <li class="breadcrumb-item">Settings</li>
                <li class="breadcrumb-item active">Opening Hours</li>
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
                            <a class="btn btn-info" href="{{ route('retailer.opening-hours.edit', ['shop'=> $shop]) }}" role="button">
                                <i class="fas fa-pencil-alt"></i> Update Opening Hours
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Day</th>
                                    <th>From</th>
                                    <th>To</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    // $for_monday = $shop->modified_opening_hours->forDay('monday');
                                    // $the_time = explode("-", $for_monday);
                                    // dd($the_time);
                                    // dd($shop->modified_opening_hours->forDay('monday'));
                                    // $open = $shop->modified_opening_hours->forWeek();
                                    // dd($open)
                                    // dd($open['monday']->getData());
                                    // dd($shop->modified_opening_hours->asStructuredData());
                                @endphp
                                {{-- {{dd($shop->modified_opening_hours->forWeekConsecutiveDays())}} --}}
                                <tr>
                                    <td>Monday</td>
                                    @if($shop->modified_opening_hours->isOpenOn('monday'))
                                        @php $monday_time = explode("-", $shop->modified_opening_hours->forDay('monday')) @endphp
                                        
                                        <td>
                                            <input type="time" readonly class="form-control-plaintext" id="staticTimeFrom" value="{{$monday_time[0]}}">
                                        </td>
                                        <td>
                                            <input type="time" readonly class="form-control-plaintext" id="staticTimeTo" value="{{$monday_time[1]}}">
                                        </td>
                                    @else 
                                        <td>Closed</td>
                                        <td>closed</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Tuesday</td>
                                    @if($shop->modified_opening_hours->isOpenOn('tuesday'))
                                        @php $tuesday_time = explode("-", $shop->modified_opening_hours->forDay('tuesday')) @endphp
                                        
                                        <td>
                                            <input type="time" readonly class="form-control-plaintext" id="staticTimeFrom" value="{{$tuesday_time[0]}}">
                                        </td>
                                        <td>
                                            <input type="time" readonly class="form-control-plaintext" id="staticTimeTo" value="{{$tuesday_time[1]}}">
                                        </td>
                                    @else 
                                        <td>Closed</td>
                                        <td>closed</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Wednesday</td>
                                    @if($shop->modified_opening_hours->isOpenOn('wednesday'))
                                        @php $wednesday_time = explode("-", $shop->modified_opening_hours->forDay('wednesday')) @endphp
                                        
                                        <td>
                                            <input type="time" readonly class="form-control-plaintext" id="staticTimeFrom" value="{{$wednesday_time[0]}}">
                                        </td>
                                        <td>
                                            <input type="time" readonly class="form-control-plaintext" id="staticTimeTo" value="{{$wednesday_time[1]}}">
                                        </td>
                                    @else 
                                        <td>Closed</td>
                                        <td>closed</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Thursday</td>
                                    @if($shop->modified_opening_hours->isOpenOn('thursday'))
                                        @php $thursday_time = explode("-", $shop->modified_opening_hours->forDay('thursday')) @endphp
                                        
                                        <td>
                                            <input type="time" readonly class="form-control-plaintext" id="staticTimeFrom" value="{{$thursday_time[0]}}">
                                        </td>
                                        <td>
                                            <input type="time" readonly class="form-control-plaintext" id="staticTimeTo" value="{{$thursday_time[1]}}">
                                        </td>
                                    @else 
                                        <td>Closed</td>
                                        <td>closed</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Friday</td>
                                    @if($shop->modified_opening_hours->isOpenOn('friday'))
                                        @php $friday_time = explode("-", $shop->modified_opening_hours->forDay('friday')) @endphp
                                        
                                        <td>
                                            <input type="time" readonly class="form-control-plaintext" id="staticTimeFrom" value="{{$friday_time[0]}}">
                                        </td>
                                        <td>
                                            <input type="time" readonly class="form-control-plaintext" id="staticTimeTo" value="{{$friday_time[1]}}">
                                        </td>
                                    @else 
                                        <td>Closed</td>
                                        <td>closed</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Saturday</td>
                                    @if($shop->modified_opening_hours->isOpenOn('saturday'))
                                        @php $saturday_time = explode("-", $shop->modified_opening_hours->forDay('saturday')) @endphp
                                        
                                        <td>
                                            <input type="time" readonly class="form-control-plaintext" id="staticTimeFrom" value="{{$saturday_time[0]}}">
                                        </td>
                                        <td>
                                            <input type="time" readonly class="form-control-plaintext" id="staticTimeTo" value="{{$saturday_time[1]}}">
                                        </td>
                                    @else 
                                        <td>Closed</td>
                                        <td>closed</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Sunday</td>
                                    @if($shop->modified_opening_hours->isOpenOn('sunday'))
                                        @php $sunday_time = explode("-", $shop->modified_opening_hours->forDay('sunday')) @endphp
                                        
                                        <td>
                                            <input type="time" readonly class="form-control-plaintext" id="staticTimeFrom" value="{{$sunday_time[0]}}">
                                        </td>
                                        <td>
                                            <input type="time" readonly class="form-control-plaintext" id="staticTimeTo" value="{{$sunday_time[1]}}">
                                        </td>
                                    @else 
                                        <td>Closed</td>
                                        <td>closed</td>
                                    @endif
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