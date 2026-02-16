<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <title>Verification Code</title>
    <style>
        :root { color-scheme: light; }
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f5; font-family: 'Helvetica Neue', Arial, sans-serif; -webkit-text-size-adjust: none;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f4f4f5; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="480" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.06);">
                    <!-- Header -->
                    <tr>
                        <td style="padding: 36px 40px 20px; text-align: center; background: linear-gradient(135deg, #0f0f0f, #1e1e1e);">
                            <div style="font-size: 20px; letter-spacing: 5px; color: #ffffff; font-weight: 700;">
                                REAL<span style="color: #f0ce5e;">AI</span>TRADING
                            </div>
                            <p style="color: rgba(255,255,255,0.55); font-size: 11px; letter-spacing: 2px; margin: 10px 0 0; text-transform: uppercase;">Secure Verification</p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 40px;">
                            <h1 style="color: #1a1a1a; font-size: 24px; margin: 0 0 8px; font-weight: 600;">Hello, {{ $userName }}.</h1>
                            <p style="color: #6b7280; font-size: 15px; line-height: 1.6; margin: 0 0 32px;">
                                Enter this code to verify your account and complete your registration with Real AI Trading.
                            </p>

                            <!-- Code Box -->
                            <div style="background-color: #faf9f5; border: 2px solid #d4af37; border-radius: 12px; padding: 28px; text-align: center; margin: 0 0 28px;">
                                <div style="font-size: 40px; letter-spacing: 14px; color: #1a1a1a; font-weight: 700; font-family: 'Courier New', monospace;">
                                    {{ $code }}
                                </div>
                                <p style="color: #9ca3af; font-size: 11px; margin: 14px 0 0; letter-spacing: 2px; text-transform: uppercase;">
                                    Expires in 10 minutes
                                </p>
                            </div>

                            <div style="border-left: 3px solid #d4af37; padding-left: 16px; margin: 0 0 28px;">
                                <p style="color: #6b7280; font-size: 13px; line-height: 1.5; margin: 0;">
                                    If you didn't request this code, please ignore this email. Your account remains secure.
                                </p>
                            </div>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding: 20px 40px; background-color: #f9fafb; border-top: 1px solid #e5e7eb; text-align: center;">
                            <p style="color: #9ca3af; font-size: 11px; letter-spacing: 1px; margin: 0;">
                                © {{ date('Y') }} Real AI Trading. All rights reserved.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
