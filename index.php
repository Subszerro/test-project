<?php

require_once 'vendor/autoload.php';

use src\Decorator\DecoratorManager;
use src\Cache\Cache;
use src\Log\Logger;

$host = '127.0.0.1';
$user = 'user';
$password = 'test';

$DecoratorManager = new DecoratorManager($host, $user, $password, new Cache());
$DecoratorManager->setLogger(new Logger());
$response = $DecoratorManager->getResponse(['items' => '5555, 149, 2385']);

echo json_encode($response);
exit();