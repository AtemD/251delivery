<!DOCTYP html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
         @include('dashboard.retailer.includes.head')
    </head>

    <body class="sidebar-mini layout-navbar-fixed">
        <div id="retailerapp">
            <div class="wrapper">
                
                <!-- Navbar -->
                @include('dashboard.retailer.includes.navbar')
    
                <!-- Main Sidebar Container -->
                @include('dashboard.retailer.includes.main-sidebar')
    
                
                <div class="content-wrapper">
                    @include('dashboard.retailer.includes.messages')
                    <!-- Content Wrapper. Contains page content -->
                    @yield('content')
                </div>
    
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
