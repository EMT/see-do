<html>
    @include('common.head')

    <body class="{{ $event ? 'event-info-open' : '' }}">
        @include('common.header')

        <div class="site-wrapper">
            @yield('content')
        </div>

        @include('common.footer')
		@include('common.js')

    </body>
</html>
