@extends('dashboard.company.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Regions</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('company.home')}}">Home</a></li>
                    <li class="breadcrumb-item">Settings</li>
                    <li class="breadcrumb-item active">Regions</li>
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
                                <button href="#add-region" class="btn btn-primary" data-toggle="modal" data-target="#add-region">
                                    <i class="fas fa-plus xs"></i>
                                    Add Region
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Abbr.</th>
                                <th>Country</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($regions as $region)
                                    <tr>
                                        <td>{{$region->id}}</td>
                                        <td>{{$region->name}}</td>
                                        <td>{{$region->abbreviation}}</td>
                                        <td>{{$region->country->name}}</td>
                                        <td><span class="badge badge-{{$region->is_enabled == 1 ? 'primary': 'warning'}}">{{$region->is_enabled === 1 ? 'enabled': 'disabled'}}</span></td>
                                        <td class="project-actions">
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit-region-{{$region->id}}">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-region-{{$region->id}}">
                                                <i class="fas fa-trash">
                                                </i>
                                            </button>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="edit-region-{{$region->id}}" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog edit-region-{{$region->id}}">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit {{$region->name}}</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <form role="form" method="POST" action="{{ route('company.settings.regions.update', ['region' => $region->id]) }}">
                                                @method('PUT')
                                                @csrf

                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" class="form-control" id="name" name="name" value="{{ $region->name }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="abbreviation">Abbr.</label>
                                                        <input type="text" class="form-control" id="abbreviation" name="abbreviation" value="{{ $region->abbreviation }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="country_id">Country</label>
                                                        <select class="form-control" id="country_id" name="country_id" value="{{ old('country_id') }}" required>
                                                            <option value="">Choose Country</option>
                                                            @foreach($countries as $country)
                                                              <option value="{{ $country->id }}" 
                                                                  {{ ($region->country->id == $country->id) ? 'selected' : ''}}>
                                                                {{ $country->name }}
                                                              </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" id="region-switch-{{$region->id}}" name="status" {{$region->is_enabled === 1 ? 'checked' : ''}}>
                                                            <label class="custom-control-label" for="region-switch-{{$region->id}}">Region Status</label>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>

                                    <div class="modal fade" id="delete-region-{{$region->id}}" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog delete-region-{{$region->id}}">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Delete {{$region->name}}</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <form role="form" method="POST" action="{{ route('company.settings.regions.destroy', ['region' => $region->id]) }}">
                                                @method('DELETE')
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="alert alert-danger" role="alert">
                                                        Are you sure you want to delete <b>{{$region->name}}</b> Region!
                                                        <br>
                                                        <small>This action is irreversible!</small>
                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>

                                @empty
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-warning">
                                                <h5><i class="icon fas fa-warning"></i> No Region Registered Yet!</h5>
                                                register at least one region.
                                            </div>
                                        </div>
                                    </div>
                                @endempty

                                <div class="modal fade" id="add-region" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog add-region">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add New Region</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        
                                        <form role="form" method="POST" action="{{ route('company.settings.regions.store') }}">
                                            @csrf

                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" id="name" placeholder="name" name="name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="abbreviation">Abbr.</label>
                                                    <input type="text" class="form-control" id="abbreviation" placeholder="abbreviation" name="abbreviation" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="country_id">Country</label>
                                                    <select class="form-control" id="country_id" name="country_id" value="{{ old('country_id') }}" required>
                                                        <option value="">Choose Country</option>
                                                        @foreach($countries as $country)
                                                          <option value="{{ $country->id }}">
                                                            {{ $country->name }}
                                                          </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="new-region-switch" name="status">
                                                        <label class="custom-control-label" for="new-region-switch">Status (Enable/Disable)</label>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Create</button>
                                            </div>
                                        </form>

                                    </div>
                                    <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>

                            </tbody>
                        </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                {{$regions->links()}}
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
    </div>
@endsection