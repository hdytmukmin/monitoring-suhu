<?php

namespace App\Jobs;

use App\Models\NotificationLog;
use App\Services\NotificationSenderService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendTemperatureAlert implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;

    public function __construct(public NotificationLog $log)
    {
    }

    public function handle(NotificationSenderService $sender): void
    {
        try {
            $sender->send($this->log);

            $this->log->update([
                'status' => 'sent',
                'sent_at' => now(),
                'error_message' => null,
            ]);
        } catch (\Throwable $exception) {
            $this->log->update([
                'status' => 'failed',
                'error_message' => $exception->getMessage(),
            ]);

            throw $exception;
        }
    }
}
