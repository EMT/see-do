<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <center>

            <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="max-width:600px;">
                <tr>
                    <td align="center" valign="top">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">

                            <tr style="width: 100%;">
                                <td valign="top" style="width: 100%;">
                                    <a href="{{ URL::to('/') }}?utm_source=See%2BDo%20Email%20Header&utm_medium=Email&utm_campaign=See%2BDo%20Email%20Header" style="text-decoration: none;">
                                        <img src="https://see-and-do.com/assets/img/see-do-email-header.png" alt="See+Do" style="width: 100%; padding-bottom: 45px;" />
                                    </a>
                                </td>
                            </tr>

                            <tr style="width: 100%;">
                                <td valign="top" style="width: 100%; padding-bottom: 8px;">
                                    <p>Hi {{ $subscriber->name }},</p>
                                    <p>A few things you might like to See+Do in {{$city->name}} over the next couple of weeks…</p>
                                </td>
                            </tr>

                            @foreach($events as $ev)
                                <tr style="width: 100%;">
                                    <td valign="top" style="width: 100%; padding-top: 16px; border-bottom: 1px solid #EEEEEE;">
                                        <div style="font-weight: bold;"><a href="{{ route('{city}.events.show', array($city->iata, $ev->slug)) }}" style="text-decoration: none; color: #2e69ff;">{!! $ev->title !!}</a></div>
                                        <div>{{ $ev->longDates() }}</div>
                                        <div>{!! $ev->parseMarkdown('content') !!}</div>
                                    </td>
                                </tr>
                            @endforeach

                            <tr style="width: 100%;">
                                <td valign="top" style="width: 100%; padding-bottom: 32px;">
                                    <p>See+Do</p>
                                </td>
                            </tr>

                            <tr style="width: 100%;">
                                <td valign="top" style="width: 100%; padding-bottom: 16px;">
                                    <div style="border-bottom: 1px solid #EEEEEE; padding-bottom: 7px; margin-bottom: 8px">More from See+Do</div>

                                    @foreach( $categories as $cat )
                                        @if( $cat->futureEventsCount($city->iata) )
                                            —<a href="{{ route('{city}.categories.show', ['slug' => $cat->slug, 'city' => $city->iata]) }}?utm_source=See%2BDo%20Email%20Footer&utm_medium=Email&utm_campaign=See%2BDo%20Email%20Footer">
                                                    {{ $cat->title }} <span class="nav-num"><span class="nav-open-bracket">[</span><span class="nav-num-inner">{{ $cat->futureEventsCount($city->iata) }}</span><span class="nav-close-bracket">]</span></span>
                                                </a>
                                            <br />
                                        @endif
                                    @endforeach

                                </td>
                            </tr>

                            <tr style="width: 100%;">
                                <td valign="top" style="width: 100%; padding-bottom: 16px;">
                                    @include('emails.subscribers.footer')
                                </td>
                            </tr>

                        </table>
                    </td>
                </tr>
            </table>

        </center>
    </body>
</html>