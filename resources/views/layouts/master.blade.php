<html>
    @include('common.head')

    <body>
        @include('common.header')

        <div class="site-wrapper">
            @yield('content')
        </div>

        @include('common.footer')
		@include('common.js')

    </body>
</html>
