<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <p>Hi {{$request->name}},</p>
        <p>You can now register for See+Do with the following url.</p>
        <a href="{{ URL::to('/') }}/auth/register/{{ $token->token }}">{{ URL::to('/') }}/auth/register/{{ $token->token }}</a>
        <br>
        <p>Thank You,</p>
        <p>Fieldwork</p>
    </body>
</html>