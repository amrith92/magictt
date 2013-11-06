<?php

namespace Library\Controller;

use \HttpResponse;
use Library\Configurator\Configurator;

abstract class AbstractController {
	protected $configuration;
	
	protected function __construct() {
		$this->configuration = new Configurator;
	}
	
	public function __destruct() {

	}
	
	public function getSession() {
		return $this->configuration->getRegistry()->getService('session');
	}
	
	public function getDatabase() {
		return $this->configuration->getRegistry()->getService('database');
	}
	
	public function renderView($path, array $params = array()) {
		$path = ROOT . DIRECTORY_SEPARATOR . 'ui' . DIRECTORY_SEPARATOR . $path;
		
		if (\is_readable($path)) {
			HttpResponse::setCache(true);
			HttpResponse::setHeader('X-Served-By', 'Treebeard, Ent Lord');
			HttpResponse::capture();
			
			\extract($params);
			include_once $path;
			
			exit();
		}
		
		throw new \Exception("Path ({$path}) not readable/does not exist!");
	}
}

