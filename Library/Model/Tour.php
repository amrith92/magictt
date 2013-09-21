<?php 

namespace Library\Model;

class Tour implements TourInterface {

	private $id;
	private $name;
	private $description;
	private $pictureUrl;
	private $price;
	private $stopovers;
	
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
	
	public function getName() { 
		return $this->name;
	}

	public function setName($name) {
 		if(\strlen($name) > 2) {
			$this->name = $name;
		}
		else {
			throw new \InvalidArgumentException("Too short for a name!");
		}
  }
	public function getDescription() {
		return $this->description;
	}

	public function setDescription($desc) {
		if(\strlen($desc) > 15) {
			$this->description = $desc;
		}
		else {
			throw new \InvalidArgumentException("Too short for a description!");
		}
	}

	public function getPicture() {
		return $this->pictureUrl = $pictureUrl;
  }

	public function setPicture($pictureUrl) {
			if (filter_var($pictureUrl, FILTER_VALIDATE_URL)) {
			$this->pictureUrl = $pictureUrl;
		}
		else {
			throw new \InvalidArgumentException("Invalid picture url!"); 
		}
	}

	public function getPrice() {
		return $this->price;	
	}

	public function setPrice($price) {
		if (!\is_float($price) || $price <= 0) {
			throw new \InvalidArgumentException("Price cannot be less than 0");		
		}
		$this->price = $price;
	}

	public function getStopovers() {
		return $this->stopovers;
	}

	public function setStopovers(array $stopovers) {
		if(count($stopovers) >= 1) {
			$this->stopovers = $stopovers;
		}
		else { 
			throw new \InvalidArgumentException("Minimum one stopover should be there!");
		}
  }
	public function addStopover(Stopover $theStopover) {
		$this->stopovers[] = $theStopover;
	}

	public function removeStopover(Stopover $theStopover) {
				
		for ($i = 0, $term = count($this->stopovers); $i < $term; ++$i) {
  		if ($this->stopovers == $theStopover) {
				 $index = $i;
			}
		}
		if(isset($index)) {
			unset($this->stopovers[$index]);		
		}	
		else {
			throw new \BadMethodCallException("No such stopover to remove!");		
		}
	}
}
