<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Verify your email address</title>
        <style type="text/css" rel="stylesheet" media="all">
            *:not(br):not(tr):not(html) {
                font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
            }
            body {
                width: 100% !important;
                height: 100%;
                margin: 0;
                line-height: 1.4;
                background-color: #F5F7F9;
                color: #839197;
                -webkit-text-size-adjust: none;
            }
            a {
                color: #414EF9;
            }
            .email-wrapper {
                width: 100%;
                margin: 0;
                padding: 0;
                background-color: #F5F7F9;
            }
            .email-content {
                width: 100%;
                margin: 0;
                padding: 0;
            }
            .email-masthead {
                padding: 25px 0;
                text-align: center;
            }
            .email-masthead_logo {
                max-width: 400px;
                border: 0;
            }
            .email-masthead_name {
                font-size: 16px;
                font-weight: bold;
                color: #839197;
                text-decoration: none;
                text-shadow: 0 1px 0 white;
            }
            .email-body {
                width: 100%;
                margin: 0;
                padding: 0;
                border-top: 1px solid #E7EAEC;
                border-bottom: 1px solid #E7EAEC;
                background-color: #FFFFFF;
            }
            .email-body_inner {
                width: 570px;
                margin: 0 auto;
                padding: 0;
            }
            .email-footer {
                width: 570px;
                margin: 0 auto;
                padding: 0;
                text-align: center;
            }
            .email-footer p {
                color: #839197;
            }
            .body-action {
                width: 100%;
                margin: 30px auto;
                padding: 0;
                text-align: center;
            }
            .body-sub {
                margin-top: 25px;
                padding-top: 25px;
                border-top: 1px solid #E7EAEC;
            }
            .content-cell {
                padding: 35px;
            }
            .align-right {
                text-align: right;
            }
            h1 {
                margin-top: 0;
                color: #292E31;
                font-size: 19px;
                font-weight: bold;
                text-align: left;
            }
            h2 {
                margin-top: 0;
                color: #292E31;
                font-size: 16px;
                font-weight: bold;
                text-align: left;
            }
            h3 {
                margin-top: 0;
                color: #292E31;
                font-size: 14px;
                font-weight: bold;
                text-align: left;
            }
            p {
                margin-top: 0;
                color: #839197;
                font-size: 16px;
                line-height: 1.5em;
                text-align: left;
            }
            p.sub {
                font-size: 12px;
            }
            p.center {
                text-align: center;
            }
            .button {
                display: inline-block;
                width: 200px;
                background-color: #414EF9;
                border-radius: 3px;
                color: #ffffff;
                font-size: 15px;
                line-height: 45px;
                text-align: center;
                text-decoration: none;
                -webkit-text-size-adjust: none;
                mso-hide: all;
            }
            .button--green {
                background-color: #28DB67;
            }
            .button--red {
                background-color: #FF3665;
            }
            .button--blue {
                background-color: #414EF9;
            }
        </style>
    </head>
    <body>
        <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td align="center">
                    <table class="email-content" width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="email-body" width="100%">
                                <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td class="content-cell">
                                            <h1>Verify for Change password</h1>
                                            <table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <td align="center">
                                                        <div>
                                                            <a href='<?php echo url('/'); ?>/forgot/change_password/{{ $code }}' class="button button--blue" style="color: white;">Verify Email</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                            <p>Thanks,</p>
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