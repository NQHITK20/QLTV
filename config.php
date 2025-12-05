<?php
// Simple .env loader and config bootstrap for the app
// Places values into getenv(), $_ENV and defines convenient constants.

$envPath = __DIR__ . '/.env';
$env = [];
if (file_exists($envPath)) {
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || $line[0] === '#') continue;
        if (strpos($line, '=') === false) continue;
        list($k, $v) = explode('=', $line, 2);
        $k = trim($k);
        $v = trim($v);
        $v = trim($v, "\"'\n\r");
        $env[$k] = $v;
        if (getenv($k) === false) putenv("$k=$v");
        $_ENV[$k] = $v;
        $_SERVER[$k] = $v;
    }
}

// Defaults
define('BACKEND_URL', isset($env['BACKEND_URL']) ? $env['BACKEND_URL'] : 'http://localhost:8000');
define('APP_BASE', isset($env['APP_BASE']) ? $env['APP_BASE'] : '/QLTV');

// Expose minimal config to client-side JS (in pages that include this file early)
// This echo is safe because values are JSON-encoded.
echo "<script>window.APP_CONFIG = { backendUrl: " . json_encode(BACKEND_URL) . ", appBase: " . json_encode(APP_BASE) . " };</script>\n";

?>
