@extends('dashboard.company.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Users List</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('company.home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Users</li>
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
                            <company-user-add></company-user-add>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Roles</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->full_name}}</td>
                                    <td>{{$user->phone_number}}</td>
                                    <td>{{$user->email}}</td>
                                    
                                    @if(!empty($user->userAccountStatus->name))
                                        <td><span class="badge badge-{{$user->userAccountStatus->color}}">{{$user->userAccountStatus->name}}</span></td>
                                    @else 
                                        <td><span class="badge badge-warning">Null</span></td>
                                    @endif

                                    <td class="text-wrap">
                                        @forelse($user->roles as $role)
                                            <span class="badge badge-primary">{{$role->name}}</span>
                                        @empty 
                                            <span class="badge badge-warning">No Role Assigned</span>
                                        @endforelse
                                    </td>

                                    <td class="project-actions">
                                        <a class="btn btn-info btn-sm" href="{{ route('company.users.edit', ['user' => $user->slug]) }}" role="button">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-user-{{$user->id}}">
                                            <i class="fas fa-trash">
                                            </i>
                                        </button>

                                        <!-- A model window to delete a single permission -->
                                        <div class="modal fade" id="delete-user-{{$user->id}}" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><b class="text-danger">Delete</b> {{$user->full_name}}</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form role="form" method="POST" action="{{ route('company.users.destroy', ['user' => $user]) }}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <div class="modal-body">
                                                        
                                                        <div class="alert alert-danger alert-dismissible text-wrap">
                                                            <h5><i class="icon fas fa-ban"></i> Warning!</h5>
                                                            <small class="text-danger">This action is irreversible!</small><br>

                                                            <p>Are you sure you want to delete the user <strong>{{$user->full_name}}</strong>?</p>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-primary" data-dismiss="modal">No Cancel</button>
                                                        <button type="submit" class="btn btn-danger">Yes Delete</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                            </div>
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </td>
                                </tr>

                            @empty
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-warning">
                                            <h5><i class="icon fas fa-warning"></i> No user Registered Yet!</h5>
                                            Get at least one user to register.
                                        </div>
                                    </div>
                                </div>
                            @endempty

                        </tbody>
                    </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            {{$users->links()}}
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
@endsection