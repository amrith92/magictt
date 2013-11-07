<?php 

namespace Library\Model;

use Library\Mapper\EntityCollectionInterface;

class Tour extends AbstractEntity implements TourInterface {

	protected $allowedFields = [
		'id', 'name', 'description',
		'pictureUrl', 'price', 
		'views', 'category'
	];
	
	protected $stopovers;
	
	public function getId() {
		return $this->fields['id'];	
	}

	public function setId($id) {
		if (isset($this->fields['id'])) {
			throw new \BadMethodCallException("The ID is already set!");
		}
		
		$id = (int) $id;
		
		if (!\is_int($id) || $id < 1) {
			throw new \InvalidArgumentException("Invalid ID!");
		}
		
		$this->fields['id'] = $id;
		
		return $this;
	}		
	
	public function getName() { 
		return $this->fields['name'];
	}

	public function setName($name) {
 		if(\strlen($name) < 2) {
			throw new \InvalidArgumentException("Too short for a name!");
		}
		
		$this->fields['name'] = $name;
		
		return $this;
  }
  
	public function getDescription() {
		return $this->fields['description'];
	}

	public function setDescription($desc) {
		if(\strlen($desc) < 15) {
			throw new \InvalidArgumentException("Too short for a description!");
		}
		
		$this->fields['description'] = $desc;
		
		return $this;
	}

	public function setPicture($pictureUrl) {
		if (!\filter_var($pictureUrl, FILTER_VALIDATE_URL)) {
			throw new \InvalidArgumentException("Invalid picture url!");
		}
		
		$this->fields['pictureUrl'] = $pictureUrl;
		
		return $this;
	}
	
	public function getPicture() {
		return $this->fields['pictureUrl'];
  }

	public function setPrice($price) {
		if (!\is_float($price) || $price <= 0) {
			throw new \InvalidArgumentException("Price cannot be less than 0");		
		}
		
		$this->fields['price'] = $price;
		
		return $this;
	}
	
	public function getPrice() {
		return $this->fields['price'];	
	}
	
	public function setCategory($category) {
		if ($category < 0 || $category > 4) {
			throw new \InvalidArgumentException("Invalid Category");
		}
		
		$this->fields['category'] = $category;
		
		return $this;
	}
	
	public function getCategory() {
		return $this->fields['category'];
	}
	
	public function setViews($views) {
		if ($views < 0) {
			throw new \InvalidArgumentException("Invalid No. of Views");
		}
		
		$this->fields['views'] = $views;
		
		return $this;
	}
	
	public function getViews() {
		return $this->fields['views'];
	}

	public function setStopovers(EntityCollectionInterface $stopovers) {
		if(\count($stopovers) < 1) {
			throw new \InvalidArgumentException("Minimum one stopover should be there!");
		}
		
		$this->stopovers = $stopovers;
		
		return $this;
  }
  
  public function getStopovers() {
		return $this->stopovers;
	}

	public function addStopover(StopoverInterface $theStopover) {
		$this->stopovers[] = $theStopover;
	}

	public function removeStopover(StopoverInterface $theStopover) {
		foreach ($this->stopovers as $k => $over)	{
			if ($over->getId() == $theStopover->getId()) {
				unset($this->stopovers[$k]);
			}
		}
	}
}
