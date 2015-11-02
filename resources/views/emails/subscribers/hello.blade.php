<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <p>Hi {{ $subscriber->name }},</p>
        <p>Thanks for subscribing. We’ll send you fun things to See&Do every now and then.</p>
        
        @include('emails.subscribers.footer')

    </body>
</html>