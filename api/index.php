<?php

// 1. Pastikan folder storage sementara ada (Wajib untuk Vercel)
mkdir('/tmp/storage/framework/views', 0755, true);

// 2. Load composer autoload
require __DIR__ . '/../vendor/autoload.php';

// 3. Jalankan aplikasi Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';

$app->handleRequest(Illuminate\Http\Request::capture());