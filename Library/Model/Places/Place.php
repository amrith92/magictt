<?php

namespace Library\Model\Places;

class Place implements PlaceInterface {

	private $id;
	private $city;
	private $state;
	private $country;

	public function __construct(array $fields) {
		foreach($fields as $field => $value) {
			$fn = 'set'.\ucfirst($value);
			$this->$fn($value);			
		}
	}
	
	public function getId() {
		return $this->id;	
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

	public function getCity() {
		return $this->city;	
	}

	public function setCity($city) {
		if(\strlen($city) > 2) {
			$this->city = $city;
		}
		else {
			throw new \InvalidArgumentException("Too short for a City name!");
		}
	}

	public function getState() {
		return $this->state;
	}
	
	public function setState(State $state) {
		$this->state = $state;
	}

	public function getCountry() {
		return $this->country;	
	}
	
	public function setCountry(Country $country) {
		$this->country = $country; 
	}
}
