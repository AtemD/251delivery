@extends('dashboard.company.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Payment Method Editor</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('company.home')}}">Home</a></li>
                    <li class="breadcrumb-item">Settings</li>
                    <li class="breadcrumb-item"><a href="{{route('company.payment-methods.index')}}">Payment Methods</a></li>
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
                    <!-- general form elements -->
                            <!-- form start -->
                    <form role="form" method="POST" action="{{ route('company.payment-methods.update', ['payment_method' => $payment_method]) }}">
                        @method('PUT')
                        @csrf 
                        
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Edit <strong>{{$payment_method->name}}</strong> Payment Method</h3>
                            </div>
                            <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $payment_method->name }}" id="name" 
                                            placeholder="e.g CBE BIRR" required>
                                        
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="description" rows="3" name="description" required>{{ $payment_method->description }}</textarea>

                                        @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                
                                    <div class="form-group">
                                        <label>Status</label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="status" name="status" 
                                                {{$payment_method->is_enabled == 1 ? 'checked' : ''}}>
                                            <label class="custom-control-label" for="status"><small class="text-muted">(enable/disable)</small></label>
                                        </div>

                                        @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                                <!-- /.card-body -->
                        
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update Payment Method</button>
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