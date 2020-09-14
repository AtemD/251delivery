<!DOCTYP html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
         @include('dashboard.retailer.includes.head')
    </head>

    <body class="hold-transition sidebar-mini">
        <div id="retailerapp">
            <div class="wrapper">
                <!-- Navbar -->
                @include('dashboard.retailer.includes.navbar')
    
                <!-- Seoondary Sidebar Container -->
                @include('dashboard.retailer.includes.switch-shop-sidebar')

                <!-- Content Wrapper. Contains page content -->
                @yield('content')
    
                <!-- Main Footer -->
                @include('dashboard.retailer.includes.footer')
            </div>
        </div>

        @guest
            <script>
                window.Permissions = [];
            </script>
        @else
            <script>
                window.Permissions = @json(auth()->user()->allPermissions);
            </script>
        @endguest

        <!-- REQUIRED SCRIPTS -->
        <script src="/js/app.js"></script>
    </body>
</html>
