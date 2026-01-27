<?php
// Hapus baris ini setelah berhasil muncul tulisan "Laravel berhasil..."
shell_exec('php ../artisan config:clear');
shell_exec('php ../artisan route:clear');
shell_exec('php ../artisan view:clear');

require __DIR__ . '/../public/index.php';