<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRcodeController extends Controller
{
    // QRコードを生成し一時的なURLとして提供
    public function generateQRcode($reservation_id) {
        $reservation_url = url('/individual/reservation/' . $reservation_id);
        $qrCode = QrCode::format('png')->size(100)->generate($reservation_url);

        return response($qrCode)->header('Content-Type', 'image/png');
    }
}
