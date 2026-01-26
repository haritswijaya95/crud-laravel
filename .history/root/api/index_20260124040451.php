<?php

// Perbaikan: Cek dulu apakah folder sudah ada sebelum membuat
$viewPath = '/tmp/storage/framework/views';
if (!is_dir($viewPath)) {
    @mkdir($viewPath, 0755, true);
}

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

$app->handleRequest(Illuminate\Http\Request::capture());