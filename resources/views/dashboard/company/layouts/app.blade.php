<!DOCTYP html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
         @include('dashboard.company.includes.head')
    </head>

    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <!-- Navbar -->
            @include('dashboard.company.includes.navbar')

            <!-- Main Sidebar Container -->
            @include('dashboard.company.includes.main-sidebar')

            <!-- Content Wrapper. Contains page content -->
            @yield('content')

            <!-- Control Sidebar -->
            @include('dashboard.company.includes.control-sidebar')

            <!-- Main Footer -->
            @include('dashboard.company.includes.footer')
        </div>
        <!-- REQUIRED SCRIPTS -->
        <script src="/js/app.js"></script>
    </body>
</html>
