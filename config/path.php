<?php
define('SERVER_PATH', dirname(__FILE__, 2));
define ('TEMPLATE_FOLDER', 'templates/');
define('SERVER_NAME', 'PHPMONOLITHICSERVER');
define('UPLOADS_FOLDER', SERVER_PATH.'/uploads/');

include 'layers/api/routes.php';

include 'layers/controllers/user.php';

include 'layers/logic/messaging.php';
include 'layers/logic/logic.php';