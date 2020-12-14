@extends('layouts.app')

@section('content')
    <section class="content">
        <div class="error-page">
        <h2 class="headline text-warning"> 419</h2>

        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page expired.</h3>

            <p>
            We could not find the page you were looking for.
            Meanwhile, you may <a href="/login">return to dashboard</a> or try login again
            </p>
        </div>
        <!-- /.error-content -->
        </div>
        <!-- /.error-page -->
    </section>
</div>
@endsection
