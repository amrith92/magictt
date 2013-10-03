<?php

require 'Library/Autoload/SplClassLoader.php';

$loader = new SplClassLoader('Library', __DIR__);

$loader->register();

// Config
define ('ROOT', __DIR__);
define ('BASE_PATH', 'http://' . $_SERVER['HTTP_HOST']);
define ('UI_PATH', 'http://' . $_SERVER['HTTP_HOST'] . '/ui');

$controller = null;
$action = null;
$params = array();

if(isset($_GET['url'])) {
	$urlArray = array();
	$urlArray = explode("/", $_GET['url']);
	$controller = $urlArray[0];
	array_shift($urlArray);
	
	if (isset($urlArray[0])) {
		$action = $urlArray[0];
		array_shift($urlArray);
	} else {
		$action = 'index'; // Default Action
	}
	
	$params = $urlArray;
}

use Library\Controller\FrontController;

try {
	$frontController = new FrontController(array(
		'path' => ROOT . DIRECTORY_SEPARATOR . 'Controller',
		'controller' => $controller,
		'action' => $action,
		'params' => $params
	));

	$frontController->run();
} catch(\Exception $e) {
	echo '<strong>THIS</strong> went wrong -&gt; <code>' . $e->getMessage() . '</code>';
	echo '<pre>' . $e->getTraceAsString() . '</pre>';
}

