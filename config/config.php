<?php
/* Set up SMTP connection */
define('ENABLE_MESSAGING', true);
$smtp = [
    'host' => 'example.com',
    'username' => 'example',
    'password' => 'pass',
    'port' => '587'
];

// Set up the DATABASE connection
global $db_param;

$db_param = [
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database_name' => 'logistics'
];