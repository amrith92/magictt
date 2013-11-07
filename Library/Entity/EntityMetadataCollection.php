<?php

namespace Library\Entity;

class EntityMetadataCollection implements EntityMetadataCollectionInterface
{
	protected $entities = array();
	
	public function __construct(array $entities = array()) {
		if (!empty($entities)) {
			$this->entities = $entities;
		}
	}
     
	public function add($key, EntityMetadataInterface $entity) {
		$this->offsetSet($key, $entity);
	}

	public function remove($key) {
		$this->offsetUnset($key);
	}

	public function get($key) {
		return $this->offsetGet($key);
	}

	public function exists($key) {
		return $this->offsetExists($key);
	}

	public function clear() {
		$this->entities = array();
	}
	
	public function toArray() {
		return $this->entities;
	}

	public function count() {
		return count($this->entities);
	}

	public function offsetSet($key, $value) {
		$class = new \ReflectionClass($value);
		if (!$class->implementsInterface('Library\\Entity\\EntityMetadataInterface')) {
			throw new \InvalidArgumentException(
				"Could not add the metadata to the collection.");
		}
		
		if (!isset($key)) {
			$this->entities[] = $value;
		} else {
			$this->entities[$key] = $value;
		}
	}

	public function offsetUnset($key) {
		if ($key instanceof EntityMetadataInterface) {
			$this->entities = \array_filter($this->entities,
				function ($v) use ($key) {
					return $v !== $key;
				}
			);
		} else if (isset($this->entities[$key])) {
			unset($this->entities[$key]);
		}
	}

	public function offsetGet($key) {
		if (isset($this->entities[$key])) {
			return $this->entities[$key];
		}
	}

	public function offsetExists($key) {
		return ($key instanceof EntityMetadataInterface)
			? \array_search($key, $this->entities)
			: isset($this->entities[$key]);
	}

	public function getIterator() {
		return new \ArrayIterator($this->entities);
	}
}
