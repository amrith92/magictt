<?php

namespace Library\Entity;

class EntityMetadata implements EntityMetadataInterface
{
	protected $repositoryClass;
	protected $modelClass;
	protected $mapperClass;
	protected $mapperDependencies = [];
	
	public function __construct(array $config)
	{
		if (!empty($config)) {
			foreach ($config as $k => $v) {
				$fn = 'set' . \ucfirst($k);
				
				if (\method_exists($this, $fn)) {
					$this->$fn($v);
				}
			}
		}
	}
	
	public function setMapperDependencies(array $dependencies)
	{
		$this->mapperDependencies = $dependencies;
		
		return $this;
	}
	
	public function getMapperDependencies()
	{
		return $this->mapperDependencies;
	}
	
	public function setMapperClass($className, array $dependencies = [])
	{
		if (\strlen($className) < 1) {
			throw new \InvalidArgumentException("Illegal class name.");
		}
		
		if (!\class_exists($className)) {
			throw new \RuntimeException(\sprintf("No such class [%s] detected.", $className));
		}
		
		if (!empty($dependencies)) {
			foreach ($dependencies as $dep) {
				if (!\class_exists($dep)) {
					throw new \RuntimeException(\sprintf("No such class [%s] detected.", $className));
				}
			}
			
			$this->mapperDependencies = $dependencies;
		}
		
		$this->mapperClass = $className;
		
		return $this;
	}
	
	public function getMapperClass()
	{
		return $this->mapperClass;
	}
	
	public function setRepositoryClass($className)
	{
		if (\strlen($className) < 1) {
			throw new \InvalidArgumentException("Illegal class name.");
		}
		
		if (!\class_exists($className)) {
			throw new \RuntimeException(\sprintf("No such class [%s] detected.", $className));
		}
		
		$this->repositoryClass = $className;
		
		return $this;
	}
	
	public function getRepositoryClass()
	{
		return $this->repositoryClass;
	}
	
	public function setModelClass($className)
	{
		if (\strlen($className) < 1) {
			throw new \InvalidArgumentException("Illegal class name.");
		}
		
		if (!\class_exists($className)) {
			throw new \RuntimeException(\sprintf("No such class [%s] detected.", $className));
		}
		
		$this->modelClass = $className;
		
		return $this;
	}
	
	public function getModelClass()
	{
		return $this->modelClass;
	}
}
