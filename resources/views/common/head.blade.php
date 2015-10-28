<head>
	<meta charset="UTF-8">
    <title>@yield('title', 'See&Do')</title>
    <link rel="stylesheet" type="text/css" href="{{ elixir('css/app.css') }}">
    <meta name="viewport" content="width=device-width">

    @if ( !empty($event) && $event->colorScheme )
        <style id="#js-event-color-scheme">
            .event-background-color {
                background: {{ $event->colorScheme->color_1 }};
            }

            .event-primary-color {
                color: {{ $event->colorScheme->color_2 }};
            }

            .event-secondary-color {
                color: {{ $event->colorScheme->color_3 }};
            }
        </style>
    @endif
</head>