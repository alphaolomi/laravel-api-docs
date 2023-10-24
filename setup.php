<?php

// Configurations
$logFile = __DIR__ . '/storage/logs/setup.log';
$figletOutput = null;
$figletComment = null;
if (file_exists('/usr/bin/figlet')) {
    exec('/usr/bin/figlet "Setup Script"', $figletOutput);
    $figletComment = "/*\n" . implode("\n", $figletOutput) . "\n*/\n";
} else {
    $figletComment = "/*\n Setup Script\n*/\n";
}
echo implode("\n", $figletOutput) . "\n";

// Helper functions
function logMessage($message) {
    global $logFile;
    $date = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$date] - $message\n", FILE_APPEND);
    echo $message . "\n";
}

function exitWithError($message) {
    logMessage($message);
    exit(1);
}

// OS checks
if (PHP_OS_FAMILY === 'Windows' && ($_ENV['TERM'] ?? '') !== 'xterm') {
    exitWithError("Please use Git Bash to run this script.");
}

// Check for composer
logMessage("Checking for composer...");
exec('composer -V', $output, $return);
if ($return !== 0) {
    exitWithError("Composer not found. Please install composer and try again.");
}

// Check for PHP
logMessage("Checking for PHP...");
echo 'PHP Version: ' . PHP_VERSION . " found.\n";
if (!defined('PHP_VERSION_ID')) {
    exitWithError("PHP not found. Please install PHP and try again.");
}

if (PHP_VERSION_ID < 80000) {
    exitWithError('Laravel version 9 requires PHP version 8.0 or higher.');
}

// Check for required PHP extensions
$extensions = ['ctype', 'curl', 'dom', 'fileinfo', 'filter', 'hash', 'mbstring', 'openssl', 'pcre', 'pdo', 'session', 'tokenizer', 'xml', 'gd'];
$missing = array_filter($extensions, fn($extension) => !extension_loaded($extension));

if (!empty($missing)) {
    exitWithError('The following PHP extensions are missing: ' . implode(', ', $missing) . ".\nPlease install and enable the missing extensions and try again.");
}

logMessage('All Laravel version 9 extension dependencies are installed and enabled.');

// Run composer install
logMessage("Running composer install...");
exec('composer install');

// Copy .env.example to .env
logMessage("Copying .env.example to .env...");
exec('cp .env.example .env');

// Generate application key
logMessage("Generating application key...");
exec('php artisan key:generate');

// Create database.sqlite file
logMessage("Creating database.sqlite file...");
exec('touch database/database.sqlite');

// Run migrations
logMessage("Running migrations...");
exec('php artisan migrate');

// Seed the database
logMessage("Seeding the database...");
exec('php artisan db:seed');

// Clear the cache
logMessage("Clearing the cache...");
exec('php artisan optimize:clear');

// Start the server
logMessage("Starting the server...");
logMessage("Please follow the instructions below to start the server.\n\nRun the following command to start the server:\nphp artisan serve --host=localhost --port=8000\n\nTo view the application, please open the following URLs in your browser:\nhttp://localhost:8000\nFor the API, please open the following URL in your API Tester:\nhttp://localhost:8000/api/v1");
