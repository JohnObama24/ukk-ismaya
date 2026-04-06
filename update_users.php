<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

$users = \App\Models\User::all();

foreach ($users as $user) {
    if (empty($user->username)) {
        // Use email prefix as username, or sanitize name
        $username = explode('@', $user->email)[0];
        
        // Ensure uniqueness (simple check, assuming low user count for now)
        if (\App\Models\User::where('username', $username)->exists()) {
            $username = $username . rand(1, 100);
        }

        $user->username = $username;
        $user->save();
        echo "Updated User ID: {$user->id} ({$user->name}) -> Username: {$user->username}" . PHP_EOL;
    } else {
        echo "User ID: {$user->id} already has username: {$user->username}" . PHP_EOL;
    }
}
