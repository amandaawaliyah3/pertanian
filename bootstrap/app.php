<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // 1. PENGATURAN UNTUK MEMPERCAYAI CLOUDFLARE TUNNEL SEBAGAI PROXY
        // Ini membantu Laravel mengenali HTTPS dan menangani sesi/cookie dengan benar.
        // Tanda '*' berarti mempercayai semua proxy.
        $middleware->trustProxies(at: '*');

        // 2. PENGECUALIAN CSRF UNTUK LIVEWIRE UPLOAD
        // Route Livewire upload sering bermasalah di balik proxy.
        $middleware->validateCsrfTokens(except: [
            'livewire/upload-file*', // Mengecualikan semua rute upload Livewire
            // Anda bisa tambahkan rute POST/PUT/PATCH lain yang bermasalah di sini
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();