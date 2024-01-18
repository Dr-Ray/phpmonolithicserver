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
    'database_name' => 'emg_model'
];

// Set File Upload values

$uploadConfig = [
    "allowed" => ['gif', 'jpg', 'png', 'jpeg','svg', 'mp3', 'wav'],
    "max_size" => (20*1024*1024) // => 20mb <=
];