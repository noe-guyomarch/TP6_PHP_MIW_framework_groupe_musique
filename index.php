<?php

require 'core/core.php';
require 'core/SPDO.php';
require 'core/Controller.php';
require 'core/Model.php';
//require 'controllers/Streamer.php';
//on créé un framework


//règle de routage
// www.monsite.com/
// www.monsite.com/streamer/liste
// www.monsite.com/CONTROLLER/ACTION

$webRoot = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
$request = str_replace($webRoot, '', $_SERVER['REDIRECT_URL']);

$request = explode('/', $request);
$controller = $request[0] !== ''?$request[0]:'groupe';
$action = isset($request[1]) && $request[1] !== ''?$request[1]:'liste';
define('WEB_ROOT', $webRoot);

$controller = ucfirst(strtolower($controller)).'Controller';

//$controller = StreamerController
$requestController = new $controller();
//$action = index ou liste
if (method_exists($controller, $action)) {
    $requestController->$action();
} else {
    echo '404 - method not found';
}