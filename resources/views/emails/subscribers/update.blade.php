<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <p>Hi {{ $subscriber->name }},</p>
        <p>Just a note to let you know that your settings have been updated for See&Do.</p>
        
        @include('emails.subscribers.footer')

    </body>
</html>