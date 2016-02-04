<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <p>Hi {{ $user->name }},</p>
        <p>Click here to reset your password: </p>
        <p>{{ url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}</p>
        <p>See&Do</p>
    </body>
</html>