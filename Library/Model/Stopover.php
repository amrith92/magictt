<?php 

namespace Library\Model;

class Stopover implements StopoverInterface {

	private $id;
	private $place;
	private $duration;
	private $tours;

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

	public function getPlace() {
		return $this->place;
	}
	
	public function setPlace(Place $place) {
		$this->state = $place;
	}

	public function getDuration() {
 		return $this->duration;
  }

	public function setDuration($duration) {
		if (!\is_float($duration) || $duration <= 0) {
			throw new \InvalidArgumentException("Duration cannot be less than 0");		
		}
		$this->duration = $duration
	}

	public function getTours() {
		return $this->tours;
	}

	public function setTours(array $tours) { 
		$this->tours = $tours;
	}
}
