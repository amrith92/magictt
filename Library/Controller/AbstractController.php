<?php

namespace Library\Controller;

use \HttpResponse;
use Library\Configurator\Configurator;

abstract class AbstractController {
	protected $configuration;
	
	public function __construct() {
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
	
	public function getEmail() {
		return $this->configuration->getRegistry()->getService('email');
	}
	
	public function getEntityManager() {
		return $this->configuration->getRegistry()->getService('entity.manager');
	}
	
	public function renderView($path, array $params = array()) {
		$path = ROOT . DIRECTORY_SEPARATOR . 'ui' . DIRECTORY_SEPARATOR . $path;
		
		if (\is_readable($path)) {
			HttpResponse::setCache(true);
			HttpResponse::setHeader('X-Served-By', 'Treebeard, Ent Lord');
			HttpResponse::capture();
			
			$session = $this->getSession();
			$flashes = $session->getFlashBag();
			$user = $session->getObjectBag()->get('user');
			
			\extract($params);
			include_once $path;
			
			$flashes->clear();
			
			exit();
		}
		
		throw new \Exception("Path ({$path}) not readable/does not exist!");
	}
	
	protected function respond($code, $message) {
		HttpResponse::setCache(false);
		HttpResponse::status($code);
		HttpResponse::setData($message);
		HttpResponse::send();
		exit();
	}
	
	protected function forward($path) {
		\HttpResponse::redirect(BASE_PATH . $path);
		exit();
	}
}

