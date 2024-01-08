<?php
define('SERVER_PATH', dirname(__FILE__, 2));
define ('TEMPLATE_FOLDER', 'templates/');

include 'layers/api/routes.php';

include 'layers/controllers/user.php';

include 'layers/logic/messaging.php';
include 'layers/logic/logic.php';