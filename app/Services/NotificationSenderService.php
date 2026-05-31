<?php

namespace App\Services;

use App\Models\NotificationLog;
use App\Models\NotificationSetting;
use Illuminate\Support\Facades\Http;
use InvalidArgumentException;
use RuntimeException;

class NotificationSenderService
{
    public function send(NotificationLog $log): void
    {
        match ($log->channel) {
            NotificationSetting::CHANNEL_TELEGRAM => $this->sendTelegram($log),
            NotificationSetting::CHANNEL_WHATSAPP => $this->sendWhatsApp($log),
            default => throw new InvalidArgumentException('Channel notifikasi tidak didukung.'),
        };
    }

    private function sendTelegram(NotificationLog $log): void
    {
        $botToken = config('services.telegram.bot_token');

        if (! $botToken) {
            throw new RuntimeException('TELEGRAM_BOT_TOKEN belum dikonfigurasi.');
        }

        Http::timeout(10)
            ->retry(2, 500)
            ->post("https://api.telegram.org/bot{$botToken}/sendMessage", [
                'chat_id' => $log->recipient,
                'text' => $log->message,
            ])
            ->throw();
    }

    private function sendWhatsApp(NotificationLog $log): void
    {
        $baseUrl = rtrim((string) config('services.whatsapp.base_url'), '/');
        $token = config('services.whatsapp.token');

        if (! $baseUrl || ! $token) {
            throw new RuntimeException('WHATSAPP_BASE_URL atau WHATSAPP_TOKEN belum dikonfigurasi.');
        }

        Http::withToken($token)
            ->timeout(10)
            ->retry(2, 500)
            ->post("{$baseUrl}/messages", [
                'to' => $log->recipient,
                'message' => $log->message,
            ])
            ->throw();
    }
}
