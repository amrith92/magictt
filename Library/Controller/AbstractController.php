<?php

namespace Library\Controller;

abstract class AbstractController {
	
	protected function __construct() {
		
	}
	
	public function __destruct() {

	}
	
	public function renderView($path, array $params = array()) {
		$path = ROOT . DIRECTORY_SEPARATOR . 'ui' . DIRECTORY_SEPARATOR . $path;
		
		if (\is_readable($path)) {
			\extract($params);
			include_once $path;
			
			exit();
		}
		
		throw new \Exception("Path ({$path}) not readable/does not exist!");
	}
}

