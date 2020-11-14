<!DOCTYP html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
         @include('dashboard.buyer.includes.head')
    </head>

    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <!-- Navbar -->
            @include('dashboard.buyer.includes.navbar')

            <!-- Main Sidebar Container -->
            @include('dashboard.buyer.includes.main-sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @include('dashboard.buyer.includes.messages')
                @yield('content')
            </div>

            <!-- Control Sidebar -->
            @include('dashboard.buyer.includes.control-sidebar')

            <!-- Main Footer -->
            @include('dashboard.buyer.includes.footer')
        </div>
        <!-- REQUIRED SCRIPTS -->
        <script src="/js/app.js"></script>
    </body>
</html>
