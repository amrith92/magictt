<?php

namespace Library\Model\Places;

class State extends AbstractEntity implements StateInterface {
	
	protected $allowedFields = [ 
		'id', 'state'
	];

	public function setId($id) {
		if (isset($this->fields['id'])) {
			throw new \BadMethodCallException("The ID is already set!");
		}
		if (!\is_int($id) || $id < 1) {
			throw new \InvalidArgumentException("Invalid ID!");
		}
		else {
			$this->fields['id'] = $id;
		}
	}

	public function getId() {
		return $this->fields['id'];
	}

	public function setState($state) {
		if(\strlen($state) > 2) {
			$this->fields['state'] = $state;
		}
		else {
			throw new \InvalidArgumentException("Too short for a State name!");
		}
	}

	public function getState() {
		return $this->fields['state'];	
	}
} 
