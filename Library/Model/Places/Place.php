<?php

namespace Library\Model\Places;

class Place extends AbstractEntity implements PlaceInterface {

	protected $allowedFields = [ 
		'id', 'city',
		'state','country'
	];
	
	public function getId() {
		return $this->fields['id'];	
	}

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

	public function getCity() {
		return $this->fields['city'];	
	}

	public function setCity($city) {
		if(\strlen($city) > 2) {
			$this->fields['city'] = $city;
		}
		else {
			throw new \InvalidArgumentException("Too short for a City name!");
		}
	}

	public function getState() {
		return $this->fields['state'];
	}
	
	public function setState(State $state) {
		$this->fields['state'] = $state;
	}

	public function getCountry() {
		return $this->fields['country'];	
	}
	
	public function setCountry(Country $country) {
		$this->country = $country; 
	}
}
