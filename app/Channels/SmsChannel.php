<?php

namespace App\Channels;

use App\Notifications\ReportExceptionNotification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public static function send($notifiable, ReportExceptionNotification $notification)
    {

        Http::fake(function ($request) use ($notification) {
            return Http::response(json_encode([
                'return' => [
                    'status' => 200,
                    'message' => __('general.messages.confirmed'),
                ],
            ]), 200, [
                'Content-Type' => 'application/json',
            ]);
        });

        $response = Http::get('https://api.kavenegar.com/v1/sms/send.json', [
            'message' => $notification->message,
            'trace' => $notification->trace,
        ]);

        Log::info($response->body());
    }
}
