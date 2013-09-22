<?php 

namespace Library\Model;

class Stopover implements StopoverInterface {

	protected $allowedFields = [	
		'id', 'place',
		'duration', 'tours'
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

	public function getPlace() {
		return $this->fields['place'];
	}
	
	public function setPlace(Place $place) {
		$this->fields['state'] = $place;
	}

	public function getDuration() {
 		return $this->fields['duration'];
  }

	public function setDuration($duration) {
		if (!\is_float($duration) || $duration <= 0) {
			throw new \InvalidArgumentException("Duration cannot be less than 0");		
		}
		$this->fields['duration'] = $duration;
	}

	public function getTours() {
		return $this->fields['tours'];
	}

	public function setTours(array $tours) { 
		$this->fields['tours'] = $tours;
	}
}
