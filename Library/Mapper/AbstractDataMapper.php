<?php

namespace Library\Mapper;

use Library\Database\DatabaseAdapterInterface;
use Library\Model\EntityInterface;

abstract class AbstractDataMapper implements DataMapperInterface
{
	protected $db;
	protected $table;
	protected $pkey = 'id';
	protected $collection;

	public function __construct(DatabaseAdapterInterface $db, EntityCollectionInterface $collection, $table = null) {
		$this->db = $db;
		$this->collection = $collection;
		
		if ($table != null) {
			$this->table = $table;
		}
	}	

	public function getDb() {
		return $this->db;
	}
	
	public function getTable() {
		return $this->table;
	}
	
	public function setPrimaryKey($key) {
		if (\strlen($key) < 1) {
			throw new \InvalidArgumentException("Primary key must be specified as a string.");
		}
		
		$this->pkey = $key;
		
		return $this;
	}
	
	public function getPrimaryKey() {
		return $this->pkey;
	}
	
	public function query($sql) {
		$result = $this->db->execute($sql);
		
		return $result;
	}
	
	public function queryEntity($sql) {
		$rows = $this->db->execute($sql);
		
		return $this->createCollection($rows);
	}

	public function findIt($id) {
		if (0 == (int) $id) {
			$id = "'$id'";
		}
		
		$sql = "SELECT * FROM {$this->table} WHERE {$this->pkey} = $id";
		
		$row =	$this->db->execute($sql);
		
		if (null == $row || \count($row) < 1) {
			throw new \RuntimeException(\sprintf("Query failed.<br /><pre>%s</pre>", $sql));
		}
		
		return $this->createEntity($row[0]);
 	}

	public function findAll(array $conditions = []) {
		if (!empty($conditions)) {
			$values = '';
			$comma = false; 		
			foreach($conditions as $key => $v) {
				if($comma) {
					$values .= ',';
				}
				$values .= "`$key` = $v";
				$comma = true;	
			}
		} else {
			$values = '1';
		}
		
		$sql = "SELECT * FROM {$this->table} WHERE {$values}";
		
		$rows = $this->db->execute($sql);
		
		return $this->createCollection($rows);
	}
	
	public function findInCollection(array $ids) {
		$predicate = '(';
		$predicate .= \implode(', ', $ids);
		$predicate .= ')';
		
		$sql = "SELECT * FROM {$this->table} WHERE {$this->pkey} IN {$predicate}";
		
		$rows = $this->db->execute($sql);
		
		return $this->createCollection($rows);
	}

	public function insert(EntityInterface $entity) {
		return $this->db->insert($this->table, $entity->toArray());
	}

	public function save(EntityInterface $entity) {
		return !isset($entity->id)
			? $this->db->insert($this->table, $entity)
			: $this->db->update($this->table, $entity);
	}

	public function update(EntityInterface $entity) {
		return $this->db->update($this->table, $entity);
	}

	public function delete(EntityInterface $entity) {
		return $this->db->delete($this->table, "{$this->pkey} = {$entity->id}");
	}
	
	protected function createCollection(array $rows) {
		$collection = clone($this->collection);
		$collection->clear();
		
		foreach ($rows as $row) {
			$collection[] = $this->createEntity($row);
		}
		
		return $collection;
	}
	
	abstract protected function createEntity($row); 
}
