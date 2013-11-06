<?php 

namespace Library\Model;

use Library\Model\Places\PlaceInterface;

class Stopover implements StopoverInterface {

	protected $allowedFields = [	
		'id', 'place',
		'duration'
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
		
		$this->fields['id'] = $id;
		
		return $this;
	}

	public function getPlace() {
		return $this->fields['place'];
	}
	
	public function setPlace(PlaceInterface $place) {
		$this->fields['place'] = $place;
		
		return $this;
	}

	public function getDuration() {
 		return $this->fields['duration'];
  }

	public function setDuration($duration) {
		if (!\is_float($duration) || $duration <= 0) {
			throw new \InvalidArgumentException("Duration cannot be less than 0");		
		}
		
		$this->fields['duration'] = $duration;
		
		return $this;
	}
}
