<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="x-apple-disable-message-reformatting" />
    <style type="text/css" rel="stylesheet" media="all">
        /* Base ------------------------------ */

        @import url("https://fonts.googleapis.com/css?famixly=Nunito+Sans:400,700&display=swap");

        a {
            text-decoration: none;
            color: #fff !important;
        }

        a img {
            border: none;
        }

        td {
            word-break: break-word;
        }

        /* Type ------------------------------ */

        body,
        td,
        th {
            font-family: "Nunito Sans", Helvetica, Arial, sans-serif;
        }

        h1 {
            margin-top: 0;
            color: #333333;
            font-size: 22px;
            font-weight: bold;
            text-align: center;
        }

        h2 {
            margin-top: 0;
            color: #333333;
            font-size: 16px;
            font-weight: bold;
            text-align: left;
        }

        h3 {
            margin-top: 0;
            color: #333333;
            font-size: 14px;
            font-weight: bold;
            text-align: left;
        }

        td,
        th {
            font-size: 16px;
        }

        p,
        ul,
        ol,
        blockquote {
            margin: .4em 0 1.1875em;
            font-size: 16px;
            line-height: 1.625;
        }

        .button {
            background-color: black;
            border-top: 10px solid black;
            border-right: 18px solid black;
            border-bottom: 10px solid black;
            border-left: 18px solid black;
            display: inline-block;
            color: #FFF;
            text-decoration: none;
            border-radius: 3px;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16);
            -webkit-text-size-adjust: none;
            box-sizing: border-box;
        }

        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
                text-align: center !important;
            }
        }

        .social td {
            padding: 0;
            width: auto;
        }

        .purchase_heading p {
            margin: 0;
            color: #85878E;
            font-size: 12px;
        }

        body {
            background-color: #F2F4F6;
            color: #51545E;
        }

        p {
            color: #51545E;
        }

        .email-wrapper {
            width: 100%;
            margin: 0;
            padding: 0;
            -premailer-width: 100%;
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
            background-color: #F2F4F6;
        }

        .email-content {
            width: 100%;
            margin: 0;
            padding: 0;
            -premailer-width: 100%;
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
        }
        /* Masthead ----------------------- */

        .email-masthead {
            padding: 25px 0;
            text-align: center;
        }

        /* Body ------------------------------ */

        .email-body {
            width: 100%;
            margin: 0;
            padding: 0;
            -premailer-width: 100%;
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
        }

        .email-body_inner {
            width: 570px;
            margin: 0 auto;
            padding: 0;
            -premailer-width: 570px;
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
            background-color: #FFFFFF;
        }

        .email-footer p {
            color: #A8AAAF;
        }

        .body-action {
            width: 100%;
            margin: 30px auto;
            padding: 0;
            -premailer-width: 100%;
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
            text-align: center;
        }

        .content-cell {
            padding: 45px;
        }
    </style>
</head>
<body id="body">
<table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td align="center">
            <table class="email-content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td class="email-masthead">
                        <h1 class="f-fallback">
                            Domestic Violence Rescue System
                        </h1>
                    </td>
                </tr>
                <!-- Email Body -->
                <tr>
                    <td class="email-body" width="570" cellpadding="0" cellspacing="0">
                        <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                            <!-- Body content -->
                            <tr>
                                <td class="content-cell">
                                    <div class="f-fallback">
                                        <h1>Welcome, {{$name}}!</h1>
                                        <p>You have been added to DVRS system as
                                            @if($role_id==1)
                                                Admin!
                                            @elseif($role_id==2)
                                                User!
                                            @elseif($role_id==3)
                                                Counselor!
                                            @elseif($role_id==4)
                                                Writer!
                                            @else
                                                Authorities!
                                            @endif</p>
                                        <p>We used a random encrypted word as your password to register.
                                            Please reset your password for more security.</p>
                                        <!-- Action -->
                                        <table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                            <tr>
                                                <td align="center">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
                                                        <tr>
                                                            <td align="center">
                                                                <a href="{{ route('password.request') }}" class="f-fallback button" target="_blank" x-apple-data-detectors="true">Reset your password</a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        <p>If you have any questions, feel free to contact our team again.</p>
                                        <p>Thanks,
                                            <br>Administrator</p>
                                        <!-- Sub copy -->
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
