<?php

require ('ext/Slim/Slim.php');
require ('ApiModel.php');
error_reporting(1);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app -> post('/sendPushNotification', function() {
	ApiModel::getInstance() -> sendPushNotification();
});

// http://domain.com/registerDevice
$app -> post('/registerDevice', function() {
	ApiModel::getInstance() -> registerDevice();
});

$app -> run();