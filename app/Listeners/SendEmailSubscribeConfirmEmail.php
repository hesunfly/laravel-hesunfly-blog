<?php

namespace App\Listeners;

use App\Events\EmailSubscribeConfirm;
use App\Mail\SubscribeConfirmEmail;
use App\Models\EmailConfirmCode;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailSubscribeConfirmEmail implements ShouldQueue
{
    public function __construct()
    {

    }

    public function handle(EmailSubscribeConfirm $event)
    {
        $data = $this->generateConfirmInfo($event->email);
        Mail::to($event->email)->send(new SubscribeConfirmEmail($data));
    }

    private function generateConfirmInfo($email)
    {
        $key = 'email_subscribe_confirm_' . $email;
        $code = mt_rand(111111, 999999);
        $data = [
            'email' => $email,
            'code' => $code,
            'key' => $key,
        ];

        EmailConfirmCode::create($data);

        return $data;
    }
}
