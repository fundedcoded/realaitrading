<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <title>Reset Your Password</title>
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
                            <p style="color: rgba(255,255,255,0.55); font-size: 11px; letter-spacing: 2px; margin: 10px 0 0; text-transform: uppercase;">Password Reset</p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 40px;">
                            <h1 style="color: #1a1a1a; font-size: 24px; margin: 0 0 8px; font-weight: 600;">Hello, {{ $userName }}.</h1>
                            <p style="color: #6b7280; font-size: 15px; line-height: 1.6; margin: 0 0 28px;">
                                We received a request to reset the password for your Real AI Trading account. Click the button below to set a new password.
                            </p>

                            <!-- CTA Button -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin: 0 0 28px;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ $resetUrl }}" target="_blank" style="display: inline-block; padding: 16px 48px; background: linear-gradient(135deg, #d4af37, #c4a030); color: #0a0a0a; font-size: 14px; font-weight: 700; text-decoration: none; border-radius: 12px; letter-spacing: 2px; text-transform: uppercase;">
                                            RESET PASSWORD
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <!-- Expiry Notice -->
                            <div style="background-color: #faf9f5; border: 2px solid #d4af37; border-radius: 12px; padding: 20px; text-align: center; margin: 0 0 28px;">
                                <p style="color: #9ca3af; font-size: 11px; margin: 0 0 4px; letter-spacing: 2px; text-transform: uppercase;">
                                    This link expires in
                                </p>
                                <div style="font-size: 28px; color: #1a1a1a; font-weight: 700; font-family: 'Courier New', monospace;">
                                    60 MINUTES
                                </div>
                            </div>

                            <!-- Alternative Link -->
                            <div style="background-color: #f9fafb; border-radius: 10px; padding: 16px; margin: 0 0 28px;">
                                <p style="color: #6b7280; font-size: 12px; line-height: 1.5; margin: 0 0 8px;">
                                    If the button doesn't work, copy and paste this link into your browser:
                                </p>
                                <p style="color: #d4af37; font-size: 11px; word-break: break-all; margin: 0; font-family: 'Courier New', monospace;">
                                    {{ $resetUrl }}
                                </p>
                            </div>

                            <!-- Security Note -->
                            <div style="border-left: 3px solid #d4af37; padding-left: 16px; margin: 0 0 28px;">
                                <p style="color: #6b7280; font-size: 13px; line-height: 1.5; margin: 0;">
                                    If you didn't request this password reset, please ignore this email. Your password will remain unchanged and your account stays secure.
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
