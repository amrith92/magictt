<?php

namespace Library\Model\Repository;

use Library\Model\TourInterface;

interface TourRepositoryInterface
{
	public function find($id);
	
	public function findByName($name);
	
	public function findLikeDescription($description);
	
	public function findByPriceRange($priceLow, $priceHigh);
	
	public function findByCategory($category);
	
	public function findPopular($treshhold);
	
	public function findPassingThrough(array $stopovers);

	public function findTopTen();
	
	public function findAll();
	
	public function save(TourInterface $tour);
}
