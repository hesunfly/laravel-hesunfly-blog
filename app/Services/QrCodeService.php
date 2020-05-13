<?php

namespace App\Services;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeService
{
    public static function generate($imageName)
    {
        $qrPath = 'storage/qrImage/' . $imageName . '.png';
        QrCode::format('png')
            ->size(200)
            ->backgroundColor(255, 255, 245)
            ->encoding('UTF-8')
            ->merge('/public' . CacheService::getConfig('qr_img'), .15)
            ->generate(url('/articles/' . $imageName), public_path($qrPath));

        return '/' . $qrPath;
    }
}