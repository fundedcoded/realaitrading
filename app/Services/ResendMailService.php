<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ResendMailService
{
    /**
     * Send an email via Resend HTTP API.
     */
    public static function send(string $to, string $subject, string $html): bool
    {
        $apiKey = config('services.resend.key', env('RESEND_API_KEY'));
        $from = config('mail.from.address', 'noreply@realaitrading.com');
        $fromName = config('mail.from.name', 'Real AI Trading');

        try {
            $response = Http::withToken($apiKey)
                ->timeout(10)
                ->post('https://api.resend.com/emails', [
                    'from' => "{$fromName} <{$from}>",
                    'to' => [$to],
                    'subject' => $subject,
                    'html' => $html,
                ]);

            if ($response->successful()) {
                Log::info("Resend email sent to {$to}: " . $response->json('id'));
                return true;
            }

            Log::error("Resend email failed: " . $response->body());
            return false;
        } catch (\Exception $e) {
            Log::error("Resend email exception: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Send a verification code email.
     */
    public static function sendVerificationCode(string $email, string $code, string $userName): bool
    {
        $html = view('emails.verification-code', [
            'code' => $code,
            'userName' => $userName,
        ])->render();

        return self::send($email, 'Your Verification Code — Real AI Trading', $html);
    }
}
