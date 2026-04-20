<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;

// Create user dengan email dari gambar
User::create([
    'username' => 'user123',
    'email' => 'nurulfitriamalia2005@gmail.com', 
    'password' => bcrypt('password'),
    'role' => 'peminjam'
]);

echo "User created successfully!\n";
echo "Email: nurulfitriamalia2005@gmail.com\n";
echo "Password: password\n";
echo "Role: peminjam\n";
