@extends('dashboard.retailer.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Opening Hours Editor</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('retailer.shops.index', ['shop' => $shop])}}">Home</a></li>
                <li class="breadcrumb-item">Settings</li>
                <li class="breadcrumb-item"><a href="{{route('retailer.opening-hours.index', ['shop' => $shop])}}">Opening Hours</a></li>
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
                <div class="col-md-12">
                    <!-- form start -->
                    {{-- {{ dd($shop->toArray())}} --}}
                    {{-- @php 
                        $sunday_time = $shop->modified_opening_hours->forDay('sunday');
                        dd($sunday_time);
                        
                        $sunday_time = explode("-", $shop->modified_opening_hours->forDay('sunday'));
                        dd($sunday_time[1]);
                    @endphp --}}

                    <form role="form" method="POST" action="{{ route('retailer.opening-hours.update', ['shop' => $shop]) }}">
                        @method('PUT')
                        @csrf 
                        <!-- general form elements -->
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Update Opening Hours</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form role="form" method="POST" action="{{ route('retailer.opening-hours.update', ['shop' => $shop]) }}">
                                    @method('PUT')
                                    @csrf

                                    <!--MONDAY-->
                                    <div class="form-group row">
                                      <label for="colFormLabelMonday" class="col-sm-2 col-form-label">Monday</label>
                                      @if($shop->modified_opening_hours->isOpenOn('monday'))
                                      @php $monday_time = explode("-", $shop->modified_opening_hours->forDay('monday')) @endphp

                                      <div class="col-sm-1">
                                          <small class="tex-muted">from</small>
                                      </div>

                                      <div class="col-sm-4">
                                          <input type="time" name="monday_from" class="form-control" 
                                              value="{{old('monday_from') ? old('monday_from') : $monday_time[0] }}" id="colFormLabelmondayFrom">
                                          
                                          @if($errors->has('monday_from'))
                                              <span class="text-danger">
                                                  <strong><small>*{{ $errors->first('monday_from') }}</small></strong>
                                              </span>
                                          @endif
                                      </div>

                                      <div class="col-sm-1"><small class="tex-muted">to</small></div>

                                      <div class="col-sm-4">
                                          <input type="time" name="monday_to" class="form-control" 
                                              value="{{old('monday_to') ? old('monday_to') : $monday_time[1] }}" id="colFormLabelmondayTo">

                                          @if($errors->has('monday_to'))
                                              <span class="text-danger">
                                                  <strong><small>*{{ $errors->first('monday_to') }}</small></strong>
                                              </span>
                                          @endif
                                      </div>
                                  @else 
                                      <div class="col-sm-1">
                                          <small class="tex-muted">from</small>
                                      </div>

                                      <div class="col-sm-4">
                                          <input type="time" name="monday_from" class="form-control" 
                                              value="{{old('monday_from') ? old('monday_from') : $shop->modified_opening_hours->forDay('monday')}}" id="colFormLabelmondayFrom">
                                          
                                          @if($errors->has('monday_from'))
                                              <span class="text-danger">
                                                  <strong><small>*{{ $errors->first('monday_from') }}</small></strong>
                                              </span>
                                          @endif
                                      </div>

                                      <div class="col-sm-1"><small class="tex-muted">to</small></div>

                                      <div class="col-sm-4">
                                          <input type="time" name="monday_to" class="form-control" 
                                              value="{{old('monday_to') ? old('monday_to') : $shop->modified_opening_hours->forDay('monday')}}" id="colFormLabelmondayTo">

                                          @if($errors->has('monday_to'))
                                              <span class="text-danger">
                                                  <strong><small>*{{ $errors->first('monday_to') }}</small></strong>
                                              </span>
                                          @endif
                                      </div>     
                                  @endif
                                    </div>
                                      
                                    <!--TUESDAY-->
                                    <div class="form-group row">
                                        <label for="colFormLabelTuesday" class="col-sm-2 col-form-label">Tuesday</label>
                                        @if($shop->modified_opening_hours->isOpenOn('tuesday'))
                                            @php $tuesday_time = explode("-", $shop->modified_opening_hours->forDay('tuesday')) @endphp

                                            <div class="col-sm-1">
                                                <small class="tex-muted">from</small>
                                            </div>

                                            <div class="col-sm-4">
                                                <input type="time" name="tuesday_from" class="form-control" 
                                                    value="{{old('tuesday_from') ? old('tuesday_from') : $tuesday_time[0] }}" id="colFormLabeltuesdayFrom">
                                                
                                                @if($errors->has('tuesday_from'))
                                                    <span class="text-danger">
                                                        <strong><small>*{{ $errors->first('tuesday_from') }}</small></strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="col-sm-1"><small class="tex-muted">to</small></div>

                                            <div class="col-sm-4">
                                                <input type="time" name="tuesday_to" class="form-control" 
                                                    value="{{old('tuesday_to') ? old('tuesday_to') : $tuesday_time[1] }}" id="colFormLabeltuesdayTo">

                                                @if($errors->has('tuesday_to'))
                                                    <span class="text-danger">
                                                        <strong><small>*{{ $errors->first('tuesday_to') }}</small></strong>
                                                    </span>
                                                @endif
                                            </div>
                                        @else 
                                            <div class="col-sm-1">
                                                <small class="tex-muted">from</small>
                                            </div>

                                            <div class="col-sm-4">
                                                <input type="time" name="tuesday_from" class="form-control" 
                                                    value="{{old('tuesday_from') ? old('tuesday_from') : $shop->modified_opening_hours->forDay('tuesday')}}" id="colFormLabeltuesdayFrom">
                                                
                                                @if($errors->has('tuesday_from'))
                                                    <span class="text-danger">
                                                        <strong><small>*{{ $errors->first('tuesday_from') }}</small></strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="col-sm-1"><small class="tex-muted">to</small></div>

                                            <div class="col-sm-4">
                                                <input type="time" name="tuesday_to" class="form-control" 
                                                    value="{{old('tuesday_to') ? old('tuesday_to') : $shop->modified_opening_hours->forDay('tuesday')}}" id="colFormLabeltuesdayTo">

                                                @if($errors->has('tuesday_to'))
                                                    <span class="text-danger">
                                                        <strong><small>*{{ $errors->first('tuesday_to') }}</small></strong>
                                                    </span>
                                                @endif
                                            </div>     
                                        @endif
                                    </div>

                                    <!--WEDNESDAY-->
                                    <div class="form-group row">
                                        <label for="colFormLabelWednesday" class="col-sm-2 col-form-label">Wednesday</label>
                                        @if($shop->modified_opening_hours->isOpenOn('wednesday'))
                                            @php $wednesday_time = explode("-", $shop->modified_opening_hours->forDay('wednesday')) @endphp

                                            <div class="col-sm-1">
                                                <small class="tex-muted">from</small>
                                            </div>

                                            <div class="col-sm-4">
                                                <input type="time" name="wednesday_from" class="form-control" 
                                                    value="{{old('wednesday_from') ? old('wednesday_from') : $wednesday_time[0] }}" id="colFormLabelwednesdayFrom">
                                                
                                                @if($errors->has('wednesday_from'))
                                                    <span class="text-danger">
                                                        <strong><small>*{{ $errors->first('wednesday_from') }}</small></strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="col-sm-1"><small class="tex-muted">to</small></div>

                                            <div class="col-sm-4">
                                                <input type="time" name="wednesday_to" class="form-control" 
                                                    value="{{old('wednesday_to') ? old('wednesday_to') : $wednesday_time[1] }}" id="colFormLabelwednesdayTo">

                                                @if($errors->has('wednesday_to'))
                                                    <span class="text-danger">
                                                        <strong><small>*{{ $errors->first('wednesday_to') }}</small></strong>
                                                    </span>
                                                @endif
                                            </div>
                                        @else 
                                            <div class="col-sm-1">
                                                <small class="tex-muted">from</small>
                                            </div>

                                            <div class="col-sm-4">
                                                <input type="time" name="wednesday_from" class="form-control" 
                                                    value="{{old('wednesday_from') ? old('wednesday_from') : $shop->modified_opening_hours->forDay('wednesday')}}" id="colFormLabelwednesdayFrom">
                                                
                                                @if($errors->has('wednesday_from'))
                                                    <span class="text-danger">
                                                        <strong><small>*{{ $errors->first('wednesday_from') }}</small></strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="col-sm-1"><small class="tex-muted">to</small></div>

                                            <div class="col-sm-4">
                                                <input type="time" name="wednesday_to" class="form-control" 
                                                    value="{{old('wednesday_to') ? old('wednesday_to') : $shop->modified_opening_hours->forDay('wednesday')}}" id="colFormLabelwednesdayTo">

                                                @if($errors->has('wednesday_to'))
                                                    <span class="text-danger">
                                                        <strong><small>*{{ $errors->first('wednesday_to') }}</small></strong>
                                                    </span>
                                                @endif
                                            </div>     
                                        @endif
                                    </div>

                                    <!--THURSDAY-->
                                    <div class="form-group row">
                                        <label for="colFormLabelThursday" class="col-sm-2 col-form-label">Thursday</label>
                                        @if($shop->modified_opening_hours->isOpenOn('thursday'))
                                            @php $thursday_time = explode("-", $shop->modified_opening_hours->forDay('thursday')) @endphp

                                            <div class="col-sm-1">
                                                <small class="tex-muted">from</small>
                                            </div>

                                            <div class="col-sm-4">
                                                <input type="time" name="thursday_from" class="form-control" 
                                                    value="{{old('thursday_from') ? old('thursday_from') : $thursday_time[0] }}" id="colFormLabelthursdayFrom">
                                                
                                                @if($errors->has('thursday_from'))
                                                    <span class="text-danger">
                                                        <strong><small>*{{ $errors->first('thursday_from') }}</small></strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="col-sm-1"><small class="tex-muted">to</small></div>

                                            <div class="col-sm-4">
                                                <input type="time" name="thursday_to" class="form-control" 
                                                    value="{{old('thursday_to') ? old('thursday_to') : $thursday_time[1] }}" id="colFormLabelthursdayTo">

                                                @if($errors->has('thursday_to'))
                                                    <span class="text-danger">
                                                        <strong><small>*{{ $errors->first('thursday_to') }}</small></strong>
                                                    </span>
                                                @endif
                                            </div>
                                        @else 
                                            <div class="col-sm-1">
                                                <small class="tex-muted">from</small>
                                            </div>

                                            <div class="col-sm-4">
                                                <input type="time" name="thursday_from" class="form-control" 
                                                    value="{{old('thursday_from') ? old('thursday_from') : $shop->modified_opening_hours->forDay('thursday')}}" id="colFormLabelthursdayFrom">
                                                
                                                @if($errors->has('thursday_from'))
                                                    <span class="text-danger">
                                                        <strong><small>*{{ $errors->first('thursday_from') }}</small></strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="col-sm-1"><small class="tex-muted">to</small></div>

                                            <div class="col-sm-4">
                                                <input type="time" name="thursday_to" class="form-control" 
                                                    value="{{old('thursday_to') ? old('thursday_to') : $shop->modified_opening_hours->forDay('thursday')}}" id="colFormLabelthursdayTo">

                                                @if($errors->has('thursday_to'))
                                                    <span class="text-danger">
                                                        <strong><small>*{{ $errors->first('thursday_to') }}</small></strong>
                                                    </span>
                                                @endif
                                            </div>     
                                        @endif
                                    </div>

                                    <!--FRIDAY-->
                                    <div class="form-group row">
                                        <label for="colFormLabelFriday" class="col-sm-2 col-form-label">Friday</label>
                                        @if($shop->modified_opening_hours->isOpenOn('friday'))
                                            @php $friday_time = explode("-", $shop->modified_opening_hours->forDay('friday')) @endphp

                                            <div class="col-sm-1">
                                                <small class="tex-muted">from</small>
                                            </div>

                                            <div class="col-sm-4">
                                                <input type="time" name="friday_from" class="form-control" 
                                                    value="{{old('friday_from') ? old('friday_from') : $friday_time[0] }}" id="colFormLabelfridayFrom">
                                                
                                                @if($errors->has('friday_from'))
                                                    <span class="text-danger">
                                                        <strong><small>*{{ $errors->first('friday_from') }}</small></strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="col-sm-1"><small class="tex-muted">to</small></div>

                                            <div class="col-sm-4">
                                                <input type="time" name="friday_to" class="form-control" 
                                                    value="{{old('friday_to') ? old('friday_to') : $friday_time[1] }}" id="colFormLabelfridayTo">

                                                @if($errors->has('friday_to'))
                                                    <span class="text-danger">
                                                        <strong><small>*{{ $errors->first('friday_to') }}</small></strong>
                                                    </span>
                                                @endif
                                            </div>
                                        @else 
                                            <div class="col-sm-1">
                                                <small class="tex-muted">from</small>
                                            </div>

                                            <div class="col-sm-4">
                                                <input type="time" name="friday_from" class="form-control" 
                                                    value="{{old('friday_from') ? old('friday_from') : $shop->modified_opening_hours->forDay('friday')}}" id="colFormLabelfridayFrom">
                                                
                                                @if($errors->has('friday_from'))
                                                    <span class="text-danger">
                                                        <strong><small>*{{ $errors->first('friday_from') }}</small></strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="col-sm-1"><small class="tex-muted">to</small></div>

                                            <div class="col-sm-4">
                                                <input type="time" name="friday_to" class="form-control" 
                                                    value="{{old('friday_to') ? old('friday_to') : $shop->modified_opening_hours->forDay('friday')}}" id="colFormLabelfridayTo">

                                                @if($errors->has('friday_to'))
                                                    <span class="text-danger">
                                                        <strong><small>*{{ $errors->first('friday_to') }}</small></strong>
                                                    </span>
                                                @endif
                                            </div>     
                                        @endif
                                    </div>

                                    <!--SATURDAY-->
                                    <div class="form-group row">
                                        <label for="colFormLabelSaturday" class="col-sm-2 col-form-label">Saturday</label>
                                        @if($shop->modified_opening_hours->isOpenOn('saturday'))
                                        @php $saturday_time = explode("-", $shop->modified_opening_hours->forDay('saturday')) @endphp

                                            <div class="col-sm-1">
                                                <small class="tex-muted">from</small>
                                            </div>

                                            <div class="col-sm-4">
                                                <input type="time" name="saturday_from" class="form-control" 
                                                    value="{{old('saturday_from') ? old('saturday_from') : $saturday_time[0] }}" id="colFormLabelsaturdayFrom">
                                                
                                                @if($errors->has('saturday_from'))
                                                    <span class="text-danger">
                                                        <strong><small>*{{ $errors->first('saturday_from') }}</small></strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="col-sm-1"><small class="tex-muted">to</small></div>

                                            <div class="col-sm-4">
                                                <input type="time" name="saturday_to" class="form-control" 
                                                    value="{{old('saturday_to') ? old('saturday_to') : $saturday_time[1] }}" id="colFormLabelsaturdayTo">

                                                @if($errors->has('saturday_to'))
                                                    <span class="text-danger">
                                                        <strong><small>*{{ $errors->first('saturday_to') }}</small></strong>
                                                    </span>
                                                @endif
                                            </div>
                                        @else 
                                            <div class="col-sm-1">
                                                <small class="tex-muted">from</small>
                                            </div>

                                            <div class="col-sm-4">
                                                <input type="time" name="saturday_from" class="form-control" 
                                                    value="{{old('saturday_from') ? old('saturday_from') : $shop->modified_opening_hours->forDay('saturday')}}" id="colFormLabelsaturdayFrom">
                                                
                                                @if($errors->has('saturday_from'))
                                                    <span class="text-danger">
                                                        <strong><small>*{{ $errors->first('saturday_from') }}</small></strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="col-sm-1"><small class="tex-muted">to</small></div>

                                            <div class="col-sm-4">
                                                <input type="time" name="saturday_to" class="form-control" 
                                                    value="{{old('saturday_to') ? old('saturday_to') : $shop->modified_opening_hours->forDay('saturday')}}" id="colFormLabelsaturdayTo">

                                                @if($errors->has('saturday_to'))
                                                    <span class="text-danger">
                                                        <strong><small>*{{ $errors->first('saturday_to') }}</small></strong>
                                                    </span>
                                                @endif
                                            </div>     
                                        @endif
                                    </div>

                                    <!--SUNDAY-->
                                    <div class="form-group row">
                                        <label for="colFormLabelSunday" class="col-sm-2 col-form-label">Sunday</label>
                                        @if($shop->modified_opening_hours->isOpenOn('sunday'))
                                            @php $sunday_time = explode("-", $shop->modified_opening_hours->forDay('sunday')) @endphp

                                            <div class="col-sm-1">
                                                <small class="tex-muted">from</small>
                                            </div>

                                            <div class="col-sm-4">
                                                <input type="time" name="sunday_from" class="form-control" 
                                                    value="{{old('sunday_from') ? old('sunday_from') : $sunday_time[0] }}" id="colFormLabelsundayFrom">
                                                
                                                @if($errors->has('sunday_from'))
                                                    <span class="text-danger">
                                                        <strong><small>*{{ $errors->first('sunday_from') }}</small></strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="col-sm-1"><small class="tex-muted">to</small></div>

                                            <div class="col-sm-4">
                                                <input type="time" name="sunday_to" class="form-control" 
                                                    value="{{old('sunday_to') ? old('sunday_to') : $sunday_time[1] }}" id="colFormLabelsundayTo">

                                                @if($errors->has('sunday_to'))
                                                    <span class="text-danger">
                                                        <strong><small>*{{ $errors->first('sunday_to') }}</small></strong>
                                                    </span>
                                                @endif
                                            </div>
                                        @else 
                                            <div class="col-sm-1">
                                                <small class="tex-muted">from</small>
                                            </div>

                                            <div class="col-sm-4">
                                                <input type="time" name="sunday_from" class="form-control" 
                                                    value="{{old('sunday_from') ? old('sunday_from') : $shop->modified_opening_hours->forDay('sunday')}}" id="colFormLabelsundayFrom">
                                                
                                                @if($errors->has('sunday_from'))
                                                    <span class="text-danger">
                                                        <strong><small>*{{ $errors->first('sunday_from') }}</small></strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="col-sm-1"><small class="tex-muted">to</small></div>

                                            <div class="col-sm-4">
                                                <input type="time" name="sunday_to" class="form-control" 
                                                    value="{{old('sunday_to') ? old('sunday_to') : $shop->modified_opening_hours->forDay('sunday')}}" id="colFormLabelsundayTo">

                                                @if($errors->has('sunday_to'))
                                                    <span class="text-danger">
                                                        <strong><small>*{{ $errors->first('sunday_to') }}</small></strong>
                                                    </span>
                                                @endif
                                            </div>     
                                        @endif
                                    </div>

                                </form>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Opening Hours</button>
                            </div>
                        </div>
                        <!-- /.card -->
                    </form>
                </div>
            </div>
        </div>
    <!-- /.content -->
    </section>
@endsection