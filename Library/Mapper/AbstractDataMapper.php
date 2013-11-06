<?php

namespace Library\Mapper;

class AbstractDataMapper implements DataMapperInterface {

	private $db;
	private $table;
	private $pkey = 'id';
	private $collection;

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
		$row =	$this->db->execute("SELECT * FROM " . $this->table . " WHERE {$this->pkey} = $id ");
		if($row != null) {
			return null;		
		}
		return $this->createEntity($row);
 	}

	public function findAll(array $conditions = []) {
		$values = '';
		$comma = false; 		
		foreach($conditions as $key => $v) {
			if($comma) {
				$values .= ',';
			}
			$values .= "`$key` = $v";
			$comma = true;	
		}	
		$rows = $this->db->execute("SELECT * FROM " . $this->table . " WHERE " . $values);
		
		return $this->createCollection($rows);
	}
	
	public function findInCollection(array $ids) {
		$predicate = '(';
		$predicate .= \implode(', ', $ids);
		$predicate .= ')';
		
		$rows = $this->db->execute("SELECT * FROM {$this->table} WHERE {$this->pkey} IN {$predicate}");
		
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
		$this->collection->clear();
		
		foreach ($rows as $row) {
			$this->collection[] = $this->createEntity($row);
		}
		
		return $this->collection;
	}
	
	abstract protected function createEntity($row); 
}
