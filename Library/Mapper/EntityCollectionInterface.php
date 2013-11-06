<?php

namespace Library\Mapper;

use Library\Model\EntityInterface;

interface EntityCollectionInterface extends \Countable, \ArrayAccess, \IteratorAggregate {

	public function add(EntityInterface $user);
	
	public function remove(EntityInterface $user);
	
	public function get($key);
	
	public function exists($key);
	
	public function clear();
	
	public function toArray();
}

