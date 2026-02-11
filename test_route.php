<?php

// Test file untuk memastikan route berfungsi
require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

// Clear route cache
try {
    \Artisan::call('route:clear');
    echo "Route cache cleared successfully\n";
} catch (Exception $e) {
    echo "Error clearing route cache: " . $e->getMessage() . "\n";
}

// Clear config cache
try {
    \Artisan::call('config:clear');
    echo "Config cache cleared successfully\n";
} catch (Exception $e) {
    echo "Error clearing config cache: " . $e->getMessage() . "\n";
}

// Clear view cache
try {
    \Artisan::call('view:clear');
    echo "View cache cleared successfully\n";
} catch (Exception $e) {
    echo "Error clearing view cache: " . $e->getMessage() . "\n";
}

// List routes
try {
    \Artisan::call('route:list', ['--name' => 'petugas.pengembalian.history']);
    echo "Route list result:\n";
    echo \Artisan::output();
} catch (Exception $e) {
    echo "Error listing routes: " . $e->getMessage() . "\n";
}

echo "\nTest completed!\n";
