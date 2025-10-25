<?php
// Database Configuration
define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', ''); // Update this if you have set a password
define('DB_DATABASE', 'resumewebapp');

// Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', 1); // Enable for debugging
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/error.log');

// Session Configuration
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 0); // Disabled for local testing
ini_set('session.gc_maxlifetime', 3600); // 1 hour
session_save_path(__DIR__ . '/sessions');
?>