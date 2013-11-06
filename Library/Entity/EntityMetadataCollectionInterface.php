<?php

namespace Library\Entity;

interface EntityMetadataCollectionInterface extends \Countable, \ArrayAccess, \IteratorAggregate
{
	public function add($key, EntityMetadataInterface $metadata);
	
	public function remove($key);
	
	public function get($key);
	
	public function exists($key);
	
	public function clear();
}
