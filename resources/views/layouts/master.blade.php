<html>
    @include('common.head')

    <body class="{{ !empty($event) ? 'event-info-open' : '' }}">

        <script>
        document.body.className = document.body.className.replace("event-info-open", "");
        </script>

        @include('common.header')

        <div class="site-wrapper">
            {!! Notification::showAll() !!}
            @yield('content')
        </div>

        @include('common.footer')
		@include('common.js')

    </body>
</html>
