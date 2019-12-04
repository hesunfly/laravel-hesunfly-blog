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
            ->encoding('UTF-8')
            ->merge('/public/assets/images/hesunfly-qr.png', .15)
            ->generate(url('/articles/' . $imageName), public_path($qrPath));

        return '/' . $qrPath;
    }
}