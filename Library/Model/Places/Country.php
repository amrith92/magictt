<?php

namespace Library\Model\Places;

class Country extends AbstractEntity implements CountryInterface {
	
	protected $allowedFields = [ 
		'id', 'country'
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

	public function setCountry($state) {
		if(\strlen($country) > 2) {
			$this->fields['country'] = $country;
		}
		else {
			throw new \InvalidArgumentException("Too short for a Country name!");
		}
	}

	public function getCountry() {
		return $this->fields['country'];	
	}
} 
