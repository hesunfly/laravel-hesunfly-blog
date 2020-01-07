<?php

namespace App\Listeners;

use App\Events\EmailSubscribeSuccess;
use App\Mail\SubscribeSuccessEmail;
use App\Models\Subscribe;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailSubscribeSuccessEmail implements ShouldQueue
{
    public function __construct()
    {

    }

    public function handle(EmailSubscribeSuccess $event)
    {
        Mail::to($event->email)->send(new SubscribeSuccessEmail());
    }
}
