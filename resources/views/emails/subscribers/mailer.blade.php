<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <p>Hi {{ $subscriber->name }},</p>
        <p>A few things you might like to See+Do in Manchester over the next couple of weeks…</p>

        @foreach($events as $ev)
            <div style="padding-bottom: 16px;">
                <div style="font-weight: bold;"><a href="{{ route('events.show', $ev->slug) }}">{!! $ev->title !!}</a></div>
                <div style="padding-bottom: 8px;">{{ $ev->longDates() }}</div>
                <div style="padding-bottom: 16px;">{!! $ev->parseMarkdown('content') !!}</div>
            </div>
        @endforeach

        <p>
            Have fun,
            <br /><br />
            See+Do
        </p>
        
        <br />

        <p>
            More from See+Do<br />
            ----------------------------------------------<br />
            @foreach( $categories as $cat )
                @if ( $cat->futureEventsCount() )
                    --<a href="{{ route('categories.show', ['slug' => $cat->slug]) }}?utm_source=See%2BDo%20Email%20Footer&utm_medium=Email&utm_campaign=See%2BDo%20Email%20Footer">
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