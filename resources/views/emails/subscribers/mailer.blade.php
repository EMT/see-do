<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <p>Hi {{ $subscriber->name }},</p>
        <p>A few things you might like to See+Do in Manchester over the next couple of weeks…</p>
        
        <table>
            @foreach($events as $ev)
                <tr>
                    <td style="padding-right: 20px;">{{ $ev->longDates() }}</td>
                    <td>
                        <a href="{{ route('events.show', $ev->slug) }}">
                            {!! $ev->title !!}
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>

        <p>
            Have fun,
            <br /><br />
            See+Do
        </p>
        
        <br />

        <p>
            ----------------------------------------------<br />
            @foreach( $categories as $cat )
                @if ( $cat->futureEventsCount() )
                    --<a href="{{ route('categories.show', ['slug' => $cat->slug]) }}">
                            {{ $cat->title }} <span class="nav-num"><span class="nav-open-bracket">[</span><span class="nav-num-inner">{{ $cat->futureEventsCount() }}</span><span class="nav-close-bracket">]</span></span>
                        </a>
                    <br />
                @endif

            @endforeach
            ----------------------------------------------
        </p>

        @include('emails.subscribers.footer')

    </body>
</html>