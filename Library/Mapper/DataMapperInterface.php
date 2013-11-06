<?php

namespace Library\Mapper;

use Library\Model\EntityInterface;

interface DataMapperInterface {
	
	public function getDb();
	
	public function getTable();
	
	public function setPrimaryKey($key);
	
	public function getPrimaryKey();

	public function findIt($id);

	public function findAll(array $conditions = []);
	
	public function findInCollection(array $ids);

	public function insert(EntityInterface $entity);

	public function save(EntityInterface $entity);

	public function update(EntityInterface $entity);

	public function delete(EntityInterface $entity);
	
	public function query($sql);
	
	public function queryEntity($sql);
}
