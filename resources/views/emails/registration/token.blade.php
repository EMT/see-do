<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <p>Hi {{$request->name}},</p>
        <p>Register with the following link</p>
        <a href="{{ URL::to('/') }}/auth/register/{{ $token->token }}">{{ URL::to('/') }}/auth/register/{{ $token->token }}</a>
    </body>
</html>