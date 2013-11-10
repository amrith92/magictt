<?php

namespace Library\Entity;

use Library\Database\DatabaseAdapterInterface;
use Library\Mapper\EntityCollectionInterface;

class EntityManager implements EntityManagerInterface
{
	protected $databaseAdapter;
	protected $entityCollectionClass;
	protected $metadataCollection;
	
	public function __construct(DatabaseAdapterInterface $databaseAdapter, $collectionClass)
	{
		$this->databaseAdapter = $databaseAdapter;
		$this->entityCollectionClass = $collectionClass;
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
		
		$this->metadataCollection['Ticket'] = new EntityMetadata([
			'modelClass' => 'Library\\Model\\Ticket',
			'mapperClass' => 'Library\\Mapper\\TicketMapper',
			'repositoryClass' => 'Library\\Model\\Repository\\TicketRepository'
		]);
		
		$this->metadataCollection['User'] = new EntityMetadata([
			'modelClass' => 'Library\\Model\\User',
			'mapperClass' => 'Library\\Mapper\\UserMapper',
			'repositoryClass' => 'Library\\Model\\Repository\\UserRepository'
		]);
		
		$this->metadataCollection['Booking'] = new EntityMetadata([
			'modelClass' => 'Library\\Model\\Booking',
			'mapperClass' => 'Library\\Mapper\\BookingMapper',
			'mapperDependencies' => [
				'User',
				'Tour',
				'Ticket'
			],
			'repositoryClass' => 'Library\\Model\\Repository\\BookingRepository'
		]);
	}
	
	protected function resolveMapperDependency($entityName)
	{
		if (\array_key_exists($entityName, $this->metadataCollection->toArray())) {
			$em = $this->metadataCollection[$entityName];
			
			$klass = $em->getMapperClass();
			$deps = $em->getMapperDependencies();
			
			$params = [$this->databaseAdapter, new $this->entityCollectionClass];
			
			if (!empty($deps)) {
				foreach ($deps as $d) {
					$obj = $this->resolveMapperDependency($d);
					
					if (null != $obj) {
						$params[] = $obj;
					}
				}
			}
			
			try {
				$reflection = new \ReflectionClass($klass);
				
				$instance = $reflection->newInstanceArgs($params);
			} catch (\Exception $e) {
				throw new \RuntimeException($e->getMessage());
			}
			
			return $instance;
		} else {
			return null;
		}
	}
	
	public function getRepository($entityName)
	{
		if (\array_key_exists($entityName, $this->metadataCollection->toArray())) {
			$em = $this->metadataCollection[$entityName];
			
			$repo = $em->getRepositoryClass();
			$mapper = $this->resolveMapperDependency($entityName);
			
			return new $repo($mapper);
		} else {
			throw new \RuntimeException(\sprintf("Entity [%s] could not be resolved.", $entityName));
		}
	}
	
	public function getMapper($entityName)
	{
		if (\array_key_exists($entityName, $this->metadataCollection->toArray())) {
			$mapper = $this->resolveMapperDependency($entityName);
			
			return $mapper;
		} else {
			throw new \RuntimeException(\sprintf("Entity [%s] could not be resolved.", $entityName));
		}
	}
	
	public function createNew($entityName, array $args = array())
	{
		if (\array_key_exists($entityName, $this->metadataCollection->toArray())) {
			$em = $this->metadataCollection[$entityName];
			
			$modelClass = $em->getModelClass();
			
			try {
				$reflection = new \ReflectionClass($modelClass);
				
				$model = $reflection->newInstance($args);
			} catch (\Exception $e) {
				throw new \RuntimeException($e->getMessage());
			}
			
			return $model;
		} else {
			throw new \RuntimeException(\sprintf("Entity [%s] could not be resolved.", $entityName));
		}
	}
}
