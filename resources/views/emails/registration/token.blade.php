<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>

    </body>
</html>

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
                                    <a href="{{ URL::to('/') }}" style="text-decoration: none;">
                                        <img src="https://see-and-do.com/assets/img/see-do-email-header.png" alt="See+Do" style="width: 100%;" />
                                    </a>
                                </td>
                            </tr>

                            <tr style="width: 100%;">
                                <td valign="top" style="width: 100%; padding-bottom: 8px;">
                                    <p>Hi {{$request->name}},</p>
                                    <p>You can now register for See+Do with the following url.</p>
                                    <a href="{{ URL::to('/') }}/auth/register/{{ $token->token }}?name={{$request->name}}&email={{$request->email}}">{{ URL::to('/') }}/auth/register/{{ $token->token }}</a>
                                    <br>
                                    <p>Thank You,</p>
                                    <p>See+Do</p>
                                </td>
                            </tr>

                        </table>
                    </td>
                </tr>
            </table>

        </center>
    </body>
</html>