@extends('dashboard.company.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Regions Editor</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('company.home')}}">Home</a></li>
                    <li class="breadcrumb-item">Settings</li>
                    <li class="breadcrumb-item">Locations</li>
                    <li class="breadcrumb-item"><a href="{{route('company.regions.index')}}">Regions</a></li>
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
                    <form role="form" method="POST" action="{{ route('company.regions.update', ['region' => $region]) }}">
                        @method('PUT')
                        @csrf 
                        <!-- general form elements -->
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Edit <strong>{{$region->name}}</strong> Region</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $region->name }}" id="name" 
                                        placeholder="name of region" required>
                                    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="abbreviation">Abbreviation</label>
                                    <input type="text" name="abbreviation" class="form-control @error('abbreviation') is-invalid @enderror" value="{{ $region->abbreviation }}" id="abbreviation" 
                                        placeholder="abbreviation of region" required>
                                    
                                    @error('abbreviation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <select name="country" class="form-control @error('country') is-invalid @enderror" id="country"
                                        required>
                                        @forelse($countries as $country)
                                            <option value="{{$country->id}}" {{ $region->country->id == $country->id ? 'selected' : '' }}>
                                                {{ $country->name }}
                                            </option>
                                        @empty 
                                            <div class="alert alert-warning" role="alert">
                                                No countries to show, contact admin!
                                            </div>
                                        @endforelse
                                    </select>

                                    @error('country')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="status" name="status" 
                                            {{$region->is_enabled == 1 ? 'checked' : ''}}>
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
                                <button type="submit" class="btn btn-primary">Update Region</button>
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