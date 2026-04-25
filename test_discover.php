<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
define('LARAVEL_START', microtime(true));
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$input = new Symfony\Component\Console\Input\ArrayInput(['command' => 'package:discover']);
$output = new Symfony\Component\Console\Output\ConsoleOutput();
set_exception_handler(function ($e) {
    echo $e->getMessage().PHP_EOL;
    echo $e->getTraceAsString().PHP_EOL;
});
$status = $kernel->handle($input, $output);
echo 'Status: '.$status.PHP_EOL;
