<?php

namespace Library\Model\Places;

class State implements StateInterface {
	
	private $id;
	private $state;

	public function __construct(array $fields) {
		foreach ($fields as $field => $value) {
			$fn = 'set' . \ucfirst($field);
			$this->$fn($value);
		}
	}

	public function setId($id) {
		if (isset($this->id)) {
			throw new \BadMethodCallException("The ID is already set!");
		}
		if (!\is_int($id) || $id < 1) {
			throw new \InvalidArgumentException("Invalid ID!");
		}
		else {
			$this->id = $id;
		}
	}

	public function getId() {
		return $this->id;
	}

	public function setState($state) {
		if(\strlen($state) > 2) {
			$this->state = $state;
		}
		else {
			throw new \InvalidArgumentException("Too short for a State name!");
		}
	}

	public function getState() {
		return $this->state;	
	}
} 
