{{-- @if (request()->routeIs('retailer.*'))
  @php
    $section = 'dashboard.retailer.layouts.app';
  @endphp
@elseif (request()->routeIs('company.*'))
  @php
    $section = 'dashboard.company.layouts.app';
  @endphp
@else 
  @php
    $section = 'layouts.app';
  @endphp
@endif --}}

{{-- @extends($section) --}}
@extends('layouts.app')

@section('content')
    {{-- <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>403 Error Page</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">403 Error Page</li>
            </ol>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section> --}}

    <section class="content">
      <div class="error-page">
        <h2 class="headline text-warning"> 403</h2>

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-warning"></i>Unauthorized action !</h3>

          <p>
            This action is unauthorized, since you don't have appropriate permissions.
            Meanwhile, you may <h3><a href="{{auth()->user()->home }}">(<<< Return Back Home)</a></h3>
          </p>

        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
@endsection
