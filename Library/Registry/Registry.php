<?php

namespace Library\Registry;

class Registry implements RegistryInterface
{
	protected $services;
	
	public function __construct() {
		$this->services = [];
	}
	
	public function getService($serviceName) {
		if (\array_key_exists($serviceName, $this->services)) {
			return $this->services[$serviceName]();
		}
		
		return null;
	}
	
	public function addService($serviceName, $closure) {
		if (\array_key_exists($serviceName, $this->service)) {
			throw new \BadMethodCallException(\sprintf("Service [%s] already registered.", $serviceName));
		}
		
		$this->services[$serviceName] = $closure;
		
		return $this;
	}
}
