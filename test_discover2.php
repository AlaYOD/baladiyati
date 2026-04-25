<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
define('LARAVEL_START', microtime(true));
require __DIR__.'/vendor/autoload.php';

// Patch container to trace cache.store resolution
$app = require_once __DIR__.'/bootstrap/app.php';

// Monkey-patch the make method via extending
$originalMake = Closure::bind(function ($abstract, $parameters = []) {
    if ($abstract === 'cache.store' || $abstract === 'blade.compiler') {
        echo "RESOLVING: $abstract\n";
        debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 15);
        echo "---\n";
    }

    return $this->make($abstract, $parameters);
}, $app, get_class($app));

try {
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    echo "Bootstrap OK\n";
} catch (Throwable $e) {
    echo 'Error: '.$e->getMessage()."\n";
    echo $e->getTraceAsString()."\n";
}
