<?php

use Illuminate\Support\Facades\Route;

$appUrl = parse_url(env('APP_URL', 'http://baladiyati.test'), PHP_URL_HOST);

// 1. Central SaaS Routes (Landlord) - e.g., baladiyati.test
Route::domain($appUrl)->group(function () {
    Route::view('/', 'welcome')->name('home');
    
    // You can add your landlord admin routes here
    // Route::view('admin', 'admin.dashboard')->name('admin.dashboard');
});

// 2. Tenant Routes (Municipalities) - e.g., {municipality}.baladiyati.test
Route::middleware([
    \Spatie\Multitenancy\Http\Middleware\NeedsTenant::class,
    \Spatie\Multitenancy\Http\Middleware\EnsureValidTenantSession::class,
])->group(function () {
    
    // Default welcome page for the tenant
    Route::get('/', function () {
        $tenantName = \Spatie\Multitenancy\Models\Tenant::current()->name;
        return "Welcome to {$tenantName} - Tenant Platform";
    });

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::view('dashboard', 'dashboard')->name('dashboard');
    });

    require __DIR__.'/settings.php';
});
