<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Http\Middleware\TrustProxies as Middleware;

class TrustProxies extends Middleware
{
    /**
     * IP proxy yang dipercaya.
     *
     * @var array|string|null
     */
    protected $proxies = '*'; // Terima semua proxy (atau bisa diisi IP tertentu)

    /**
     * Header yang digunakan untuk mendeteksi proxy.
     *
     * @var int
     */
    protected $headers = Request::HEADER_X_FORWARDED_FOR |
                         Request::HEADER_X_FORWARDED_HOST |
                         Request::HEADER_X_FORWARDED_PORT |
                         Request::HEADER_X_FORWARDED_PROTO;
}
