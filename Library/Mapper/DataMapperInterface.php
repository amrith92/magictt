<?php

namespace Library\Mapper;

interface DataMapper {
	
	public function getDb();

	public function findIt($id);

	public function findAll(array $conditions = []);

	public function insert(EntityInterface $entity);

	public function save(EntityInterface $entity);

	public function update(EntityInterface $entity);

	public function delete(EntityInterface $entity);
}
