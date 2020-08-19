<!DOCTYP html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
         @include('dashboard.retailer.includes.head')
    </head>

    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <!-- Navbar -->
            @include('dashboard.retailer.includes.navbar')

            <!-- Main Sidebar Container -->
            @include('dashboard.retailer.includes.main-sidebar')

            <!-- Content Wrapper. Contains page content -->
            @yield('content')

            <!-- Control Sidebar -->
            @include('dashboard.retailer.includes.control-sidebar')

            <!-- Main Footer -->
            @include('dashboard.retailer.includes.footer')
        </div>
        <!-- REQUIRED SCRIPTS -->
        <script src="/js/app.js"></script>
    </body>
</html>
