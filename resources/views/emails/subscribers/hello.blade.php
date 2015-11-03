<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <p>Hi {{ $subscriber->name }},</p>
        <p>Thanks for subscribing. We’ll send you a weekly round-up of things to See&Do.</p>
        
        @include('emails.subscribers.footer')

    </body>
</html>