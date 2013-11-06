<?php

namespace Library\Configurator;

use Library\Registry\Registry;
use Library\Database\MysqlAdapter;
use Library\Session\EncryptedSessionHandler;
use Library\Session\Session;
use Library\Encryption\Coder3DES;
use Library\Entity\EntityManager;
use Library\Model\Collection\EntityCollection;

class Configurator
{
	protected static $registry;
	
	public function __construct() {
		self::$registry = new Registry;
		
		self::$registry->addService('database', function() {
			$params = [
				'hostname' => 'localhost',
				'username' => 'muthu',
				'password' => 'P@ssw0rd2013 !',
				'dbname' => 'magictt'
			];
			
			return new MysqlAdapter($params);
		});
		
		self::$registry->addService('session', function() {
			return new Session(new EncryptedSessionHandler(new Coder3DES));
		});
		
		self::$registry->addService('entity.manager', function() {
			$em = new EntityManager(self::$registry->getService('database'), new EntityCollection);
		});
	}
	
	public function getRegistry() {
		return self::$registry;
	}
}
