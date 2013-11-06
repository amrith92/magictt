<?php

namespace Library\Model;

class Place extends AbstractEntity implements PlaceInterface {

	protected $allowedFields = [ 
		'Id', 'Name', 'Country',
		'District', 'Population'
	];
	
	public function getId() {
		return $this->fields['Id'];	
	}

	public function setId($id) {
		if (isset($this->fields['Id'])) {
			throw new \BadMethodCallException("The ID is already set!");
		}
		if (!\is_int($id) || $id < 1) {
			throw new \InvalidArgumentException("Invalid ID!");
		}
		else {
			$this->fields['Id'] = $id;
		}	
	}

	public function setName($name) {
		if (\strlen($name) < 2) {
			throw new \InvalidArgumentException("Name too short.");
		}
		
		$this->fields['Name'] = $name;
		
		return $this;
	}
	
	public function getName() {
		return $this->fields['Name'];
	}
	
	public function setCountry(CountryInterface $country) {
		$this->fields['Country'] = $country;
		
		return $this;
	}
	
	public function getCountry() {
		return $this->fields['Country'];
	}
	
	public function setDistrict($district) {
		if (\strlen($district) < 2) {
			throw new \InvalidArgumentException("District name too short.");
		}
		
		$this->fields['District'] = $district;
		
		return $this;
	}
	
	public function getDistrict() {
		return $this->fields['District'];
	}
	
	public function setPopulation($population) {
		$population = (int) $population;
		
		if (!\is_int($population)) {
			throw new \InvalidArgumentException("Population not valid.");
		}
		
		$this->fields['Population'] = $population;
	}
	
	public function getPopulation() {
		return $this->fields['Population'];
	}
}
