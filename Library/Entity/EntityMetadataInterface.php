<?php

namespace Library\Entity;

interface EntityMetadataInterface
{
	public function setMapperDependencies(array $dependencies);
	
	public function getMapperDependencies();
	
	public function setMapperClass($className, array $dependencies);
	
	public function getMapperClass();
	
	public function setRepositoryClass($className);
	
	public function getRepositoryClass();
	
	public function setModelClass($className);
	
	public function getModelClass();
}
