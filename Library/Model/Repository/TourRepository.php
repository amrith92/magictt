<?php

namespace Library\Model\Repository;

use Library\Model\TourInterface;
use Library\Mapper\TourMapper;

class TourRepository implements TourRepositoryInterface
{
	protected $tourMapper;
	
	public function __construct(TourMapper $tourMapper)
	{
		$this->tourMapper = $tourMapper;
	}
	
	public function find($id) {
		return $this->tourMapper->findIt($id);
	}
	
	public function findByName($name) {
		return $this->tourMapper->findAll(['name' => $name]);
	}
	
	public function findLikeDescription($description) {
		$description = '%' . $description . '%';
		
		return $this->tourMapper->findAll(['description' => $description]);
	}
	
	public function findByPriceRange($priceLow, $priceHigh) {
		return $this->tourMapper->queryEntity("SELECT * FROM " . $this->tourMapper->getTable() . " WHERE price BETWEEN {$priceLow} AND {$priceHigh}");
	}
	
	public function findByCategory($category) {
		return $this->tourMapper->findAll(['category' => $category]);
	}
	
	public function findPopular($treshhold) {
		return $this->tourMapper->queryEntity("SELECT * FROM " . $this->tourMapper->getTable() . " WHERE views >= {$treshhold}");
	}
	
	public function findPassingThrough(array $stopovers) {
		foreach ($stopovers as $stopover) {
			$stopoverIds[] = $stopover->getId();
		}
		
		$sql = "SELECT t.* FROM " . $this->tourMapper->getTable() . " t,";
		$sql .= "tour_stopovers s WHERE t.id=s.tour_id AND s.stopover_id IN (";
		$sql .= \implode(', ', $stopoverIds) . ')';
		
		return $this->tourMapper->queryEntity($sql);
	}
	
	public function findAll()
	{
		return $this->tourMapper->findAll();
	}
	
	public function save(TourInterface $tour) {
		return $this->tourMapper->save($tour);
	}
}
