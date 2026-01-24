<?php

// 1. Arahkan ke vendor autoload
require __DIR__ . '/../vendor/autoload.php';

// 2. Jalankan bootstrap Laravel
// File ini akan menginisialisasi kernel Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';

// 3. Tangani request yang masuk
$app->handleRequest(Illuminate\Http\Request::capture());