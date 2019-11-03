<?php

namespace App\Listeners;

use App\Events\LoginLogEvent;
use App\Models\LoginLog;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Torann\GeoIP\Facades\GeoIP;

class LoginLogListener implements ShouldQueue
{

    public function __construct()
    {

    }

    public function handle(LoginLogEvent $event)
    {
        LoginLog::create([
            'user_id' => $event->userId,
            'ip' => $event->loginIp,
            'address' => $this->getAddress($event->loginIp),
        ]);
    }

    private function getAddress($ip)
    {
        $address = GeoIP::getLocation($ip);

        return $address->country . ' ' . $address->state_name . ' ' . $address->city;
    }

}
