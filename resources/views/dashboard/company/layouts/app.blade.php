<!DOCTYP html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
         @include('dashboard.company.includes.head')
    </head>

    <body class="hold-transition sidebar-mini">
        <div id="companyapp">
            <div class="wrapper">
                <!-- Navbar -->
                @include('dashboard.company.includes.navbar')

                <!-- Main Sidebar Container -->
                @include('dashboard.company.includes.main-sidebar')
                
                <div class="content-wrapper">
                    @include('dashboard.company.includes.messages')
                    <!-- Content Wrapper. Contains page content -->
                    @yield('content')
                </div>

                <!-- Control Sidebar -->
                @include('dashboard.company.includes.control-sidebar')

                <!-- Main Footer -->
                @include('dashboard.company.includes.footer')
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
