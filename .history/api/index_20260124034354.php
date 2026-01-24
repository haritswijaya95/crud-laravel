<?php
// Pastikan path ini benar merujuk ke file autoload di luar folder api
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

$app->handleRequest(Illuminate\Http\Request::capture());