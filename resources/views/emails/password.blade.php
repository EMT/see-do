<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <p>Hi {{ $subscriber->name }},</p>
        <p>Click here to reset your password: </p>
        <p>{{ url('password/reset/'.$token) }}</p>
        <p>See&Do</p>
    </body>
</html>