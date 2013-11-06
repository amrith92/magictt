<?php

namespace Library\Registry;

interface RegistryInterface
{
	public function getService($serviceName);
	
	public function addService($serviceName, $closure);
}
