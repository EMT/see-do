<head>
	<meta charset="UTF-8">
    <title>@yield('title', 'See+Do')</title>
    <link rel="stylesheet" type="text/css" href="{{ elixir('css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/favicon.ico') }}" />
    <meta name="viewport" content="width=device-width">

    @if ( !empty($event) )
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:site" content="@seeanddomcr" />
        <meta name="twitter:title" content="{{ $event->title }}" />
        <meta name="twitter:description" content="{{ $event->metadescription() }}" />

        <meta property="og:title" content="{{ $event->title }}" />
        <meta property="og:url" content="{{ Request::url() }}" />
        <meta property="og:description" content="{{ $event->metadescription() }}" />
    @elseif ( Route::getCurrentRoute()->uri() == '/' )
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:site" content="@seeanddomcr" />
        <meta name="twitter:title" content="See and Do, Manchester" />
        <meta name="twitter:image" content="{{ asset('assets/img/see-and-do-twitter-card.png') }}" />
        <meta name="twitter:description" content="A curated collection of cultural events across Manchester featuring listings for gigs, exhibitions, talks, films and more." />

        <meta property="og:title" content="See and Do, Manchester" />
        <meta property="og:url" content="{{ Request::url() }}" />
        <meta property="og:description" content="A curated collection of cultural events across Manchester featuring listings for gigs, exhibitions, talks, films and more." />
        <meta property="og:image" content="{{ asset('assets/img/see-and-do-twitter-card.png') }}" />
        <meta property="og:image:width" content="400" />
        <meta property="og:image:height" content="400" />
    @endif

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