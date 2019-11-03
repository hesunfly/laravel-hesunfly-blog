<?php

namespace App\Listeners;

use App\Events\UpdateLoginIpEvent;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateLoginIpListener
{

    public function __construct()
    {
        //
    }

    public function handle(UpdateLoginIpEvent $event)
    {
         User::find($event->userId)->update(['login_ip' => $event->ip]);
    }
}
