<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>.
 */

return [
   'vnpay' => [
        'client_id' => env('VNPAY_CLIENT_ID'),
        'client_secret' => env('VNPAY_CLIENT_SECRET'),
        'redirect' => env('VNPAY_REDIRECT_URI'),
    ],

];
