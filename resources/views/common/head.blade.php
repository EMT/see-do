<head>
	<meta charset="UTF-8">
    <title>@yield('title', 'See+Do')</title>
    <link rel="stylesheet" type="text/css" href="{{ elixir('css/app.css') }}">
    <meta name="viewport" content="width=device-width">

    @if ( !empty($event) && $event->colorScheme )
        <style id="#js-event-color-scheme">
            .event-background-color {
                background: {{ $event->colorScheme->color_1 }};
                fill: {{ $event->colorScheme->color_1 }};
            }

            .event-primary-color {
                color: {{ $event->colorScheme->color_2 }};
                fill: {{ $event->colorScheme->color_2 }};
            }

            .event-secondary-color {
                color: {{ $event->colorScheme->color_3 }};
                fill: {{ $event->colorScheme->color_3 }};
            }

            .event-info .body-copy a {
                color: {{ $event->colorScheme->color_3 }};
            }

            .event-info .event-info--share a:hover {
                color: {{ $event->colorScheme->color_3 }};
            }
        </style>
    @else
       <style id="#js-event-color-scheme"></style>
    @endif
</head>