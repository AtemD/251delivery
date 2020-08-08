<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('includes.head')
    </head>

    <body>
        <div id="app">
            @include('includes.nav')
            @yield('cart-bottom')
            <main class="pb-4">
                @yield('content')
            </main>
            @include('includes.footer')
        </div>
    </body>
</html>
