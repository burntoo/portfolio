<?php

use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->loadEnv(dirname(__DIR__) . '/.env');


// Database Params
define('HOST', $_ENV['HOST']);
define('DB_DRIVER', $_ENV['DB_DRIVER']);
define('DB_NAME', $_ENV['DB_NAME']);
define('DB_USER', $_ENV['DB_USER']);
define('DB_PASS', $_ENV['DB_PASS']);
define('DB_PORT', $_ENV['DB_PORT']);

// App Root
define('APP_ROOT', dirname(__DIR__) . '/App');

//URL Root
define('URL_ROOT', $_ENV['URL_ROOT']);

// Site Name
define('SITE_NAME', $_ENV['SITE_NAME']);

// FULL URL(Share Links)
# Share Link(URL)
define('SHARE_PAGE', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

// Api Endpoint Dashboard
define('DASHBOARD_API_KEY', $_ENV['DASHBOARD_API_KEY']);
define('DASHBOARD_ENDPOINT', $_ENV['DASHBOARD_ENDPOINT']);

// Mail Configuration Settings
define('MAILGUN_DOMAIN', $_ENV['MAILGUN_DOMAIN']);
define('MAILGUN_API_KEY', $_ENV['MAILGUN_API_KEY']);
define('QUERY_RECIPIENT_EMAIL', $_ENV['QUERY_RECIPIENT_EMAIL']);

// Hash Secret Key
define('HASH_SECRET_KEY', $_ENV['HASH_SECRET_KEY']);