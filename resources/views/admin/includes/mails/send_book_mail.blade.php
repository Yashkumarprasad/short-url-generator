<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Admin assign a book</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f6f9fc;
            color: #333;
        }

        .email-wrapper {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .email-header,
        .header {
            background-color: #343a40;
            padding: 20px;
            text-align: center;
            color: #ffffff;
        }

        .email-header h2,
        .email-header h1 {
            margin: 0;
            font-size: 22px;
        }

        .header h2 {
            margin: 0;
            font-size: 22px;
        }

        .email-body {
            padding: 30px;
        }

        .email-body h3 {
            margin-top: 0;
            color: #2c3e50;
        }

        .email-body h2 {
            font-size: 20px;
            color: #2c3e50;
            margin-top: 0;
        }

        .email-body p {
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .email-footer {
            background-color: #f1f1f1;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }

        .btn {
            display: inline-block;
            background-color: #007bff;
            color: #ffffff !important;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .reason-box {
            background-color: #fceaea;
            border-left: 4px solid #e74c3c;
            padding: 15px;
            margin: 20px 0;
            color: #900;
            border-radius: 4px;
        }

        .comment-box {
            background: #f8d7da;
            padding: 15px;
            border-left: 4px solid #d9534f;
            margin-top: 20px;
            font-style: italic;
            font-size: 14px;
        }

        .cta-button {
            display: inline-block;
            background-color: #0288d1;
            color: #ffffff !important;
            padding: 12px 24px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 20px;
        }

        /* content class */

        .content,
        .email-content {
            padding: 30px;
        }

        .content h3,
        .email-content h3 {
            margin-top: 0;
            color: #2c3e50;
        }

        .content h2,
        .email-content h2 {
            margin-top: 0;
            color: #2c3e50;
        }

        @media only screen and (max-width: 600px) {

            .email-body,
            .email-footer,
            .email-header {
                padding: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="email-wrapper">

        @php
            if (isset($mailData['email_content']) && !empty($mailData['email_content'])) {
                $email_content = $mailData['email_content'];
            } else {
                $email_content = \App\Models\EmailTemplate::where(['type' => $mailData['email_type']])->first()
                    ->email_content;
            }

            if (isset($mailData['created_at']) && $mailData['created_at'] != '') {
                $email_content = str_replace('[CREATED_AT]', $mailData['created_at'], $email_content);
            }

            if (isset($mailData['updated_at']) && $mailData['updated_at'] != '') {
                $email_content = str_replace('[UPDATED_AT]', $mailData['updated_at'], $email_content);
            }

            if (isset($mailData['support_email']) && $mailData['support_email'] != '') {
                $email_content = str_replace('[SUPPORT_EMAIL]', $mailData['support_email'], $email_content);
            }

            if (isset($mailData['name']) && $mailData['name'] != '') {
                $email_content = str_replace('[NAME]', $mailData['name'], $email_content);
            }

            if (isset($mailData['otp']) && $mailData['otp'] != '') {
                $email_content = str_replace('[OTP]', $mailData['otp'], $email_content);
            }

            if (isset($mailData['notes']) && $mailData['notes'] != '') {
                $email_content = str_replace('[NOTES]', $mailData['notes'], $email_content);
            }
        @endphp

        {!! $email_content !!}

        <div class="email-footer">
            &copy; {{ date('Y') }} {{ FIRM_NAME }}. All rights reserved.
        </div>
    </div>
</body>

</html>
