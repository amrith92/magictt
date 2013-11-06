<?php

namespace Library\Controller;

use \HttpResponse;
use Library\Session\EncryptedSessionHandler;
use Library\Session\Session;
use Library\Encryption\Coder3DES;

abstract class AbstractController {
	protected $session;
	
	protected function __construct() {
		$this->session = new Session(new EncryptedSessionHandler(new Coder3DES));
	}
	
	public function __destruct() {

	}
	
	public function getSession() {
		return $this->session;
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

