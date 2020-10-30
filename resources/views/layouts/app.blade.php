<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('includes.head')
    </head>

    <body>
        <div id="app">
            @include('includes.nav')
            @yield('cart-bottom')

            @include('includes.messages')
           
            <main class="pb-4">
                @yield('content')
            </main>

            <cart-details-component :cart="cart" :carttotal="cartTotal" :totalitems="totalItems"></cart-details-component>

            @include('includes.footer')
        </div>
    </body>
</html>
