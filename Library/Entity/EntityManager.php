<?php

namespace Library\Entity;

use Library\Database\DatabaseAdapterInterface;
use Library\Mapper\EntityCollectionInterface;

class EntityManager implements EntityManagerInterface
{
	protected $databaseAdapter;
	protected $entityCollection;
	protected $metadataCollection;
	
	public function __construct(DatabaseAdapterInterface $databaseAdapter, EntityCollectionInterface $collection)
	{
		$this->databaseAdapter = $databaseAdapter;
		$this->entityCollection = $collection;
		$this->metadataCollection = new EntityMetadataCollection;
		
		$this->metadataCollection['Country'] = new EntityMetadata([
			'modelClass' => 'Library\\Model\\Country',
			'mapperClass' => 'Library\\Mapper\\CountryMapper',
			'repositoryClass' => 'Library\\Model\\Repository\\CountryRepository'
		]);
		
		$this->metadataCollection['Place'] = new EntityMetadata([
			'modelClass' => 'Library\\Model\\Place',
			'mapperClass' => 'Library\\Mapper\\PlaceMapper',
			'mapperDependencies' => [
				'Country'
			],
			'repositoryClass' => 'Library\\Model\\Repository\\PlaceRepository'
		]);
		
		$this->metadataCollection['Stopover'] = new EntityMetadata([
			'modelClass' => 'Library\\Model\\Stopover',
			'mapperClass' => 'Library\\Mapper\\StopoverMapper',
			'mapperDependencies' => [
				'Place'
			],
			'repositoryClass' => 'Library\\Model\\Repository\\StopoverRepository'
		]);
		
		$this->metadataCollection['Tour'] = new EntityMetadata([
			'modelClass' => 'Library\\Model\\Tour',
			'mapperClass' => 'Library\\Mapper\\TourMapper',
			'mapperDependencies' => [
				'Stopover'
			],
			'repositoryClass' => 'Library\\Model\\Repository\\TourRepository'
		]);
	}
	
	protected function resolveMapperDependency($entityName)
	{
		if (\array_key_exists($entityName, $this->metadataCollection)) {
			$em = $this->metadataCollection[$entityName];
			
			$klass = $em->getMapperClass();
			$deps = $em->getMapperDependencies();
			
			$params = [$this->databaseAdapter, $this->entityCollection];
			
			if (!empty($deps)) {
				foreach ($deps as $d) {
					$obj = $this->resolveMapperDepency($d);
					
					if (null != $obj) {
						$params[] = $obj;
					}
				}
			}
			
			$reflection = new \ReflectionClass($klass);
			
			return $reflecton->newInstanceArgs($params);
		} else {
			return null;
		}
	}
	
	public function getRepository($entityName)
	{
		if (\array_key_exists($entityName, $this->metadataCollection)) {
			$this->entityCollection->clear();
			
			$em = $this->metadataCollection[$entityName];
			
			$repo = $em->getRepositoryClass();
			$mapper = $this->resolveMapperDependency($entityName);
			
			return new $repo($mapper);
		} else {
			throw new \RuntimeException(\sprintf("Entity [%s] could not be resolved."));
		}
	}
	
	public function getMapper($entityName)
	{
		if (\array_key_exists($entityName, $this->metadataCollection)) {
			$this->entityCollection->clear();
			
			$mapper = $this->resolveMapperDependency($entityName);
			
			return $mapper;
		} else {
			throw new \RuntimeException(\sprintf("Entity [%s] could not be resolved."));
		}
	}
}
