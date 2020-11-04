<?php

// Buat return seperti ini agar MIDTRANS di env bisa dipanggil  
return [
    'serverKey' => env('MIDTRANS_SERVER_KEY', null),
    'isProduction' => env('MIDTRANS_IS_PRODUCTION', false),
    'isSanitized' => env('MIDTRANS_IS_SANITIZED', true),
    'is3ds' => env('MIDTRANS_IS_3DS', true)
];