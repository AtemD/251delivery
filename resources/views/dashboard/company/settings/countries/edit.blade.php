@extends('dashboard.company.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Countries Editor</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('company.home')}}">Home</a></li>
                    <li class="breadcrumb-item">Settings</li>
                    <li class="breadcrumb-item">Locations</li>
                    <li class="breadcrumb-item"><a href="{{route('company.countries.index')}}">Countries</a></li>
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
                    <form role="form" method="POST" action="{{ route('company.countries.update', ['country' => $country]) }}">
                        @method('PUT')
                        @csrf 
                        <!-- general form elements -->
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Edit <strong>{{$country->name}}</strong> Country</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $country->name }}" id="name" 
                                        placeholder="name of country" required>
                                    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="abbreviation">Abbreviation</label>
                                    <input type="text" name="abbreviation" class="form-control @error('abbreviation') is-invalid @enderror" value="{{ $country->abbreviation }}" id="abbreviation" 
                                        placeholder="abbreviation of country" required>
                                    
                                    @error('abbreviation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="currency_name">Currency Name</label>
                                    <input type="text" name="currency_name" class="form-control @error('currency_name') is-invalid @enderror" value="{{ $country->currency_name }}" id="currency_name" 
                                        placeholder="eg. Dollar" required>
                                    
                                    @error('currency_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="currency_abbreviation">Currency Abbreviation</label>
                                    <input type="text" name="currency_abbreviation" class="form-control @error('currency_abbreviation') is-invalid @enderror" value="{{ $country->currency_abbreviation }}" id="currency_abbreviation" 
                                        placeholder="eg. Dollar" required>
                                    
                                    @error('currency_abbreviation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="status" name="status" 
                                            {{$country->is_enabled == 1 ? 'checked' : ''}}>
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
                                <button type="submit" class="btn btn-primary">Update Country</button>
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