<?php

namespace Library\Model\Places;

class Country implements CountryInterface {
	
	private $id;
	private $country;

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

	public function setCountry($state) {
		if(\strlen($country) > 2) {
			$this->country = $country;
		}
		else {
			throw new \InvalidArgumentException("Too short for a Country name!");
		}
	}

	public function getCountry() {
		return $this->country;	
	}
} 
