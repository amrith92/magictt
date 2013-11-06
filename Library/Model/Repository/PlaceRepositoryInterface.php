<?php

namespace Library\Model\Repository;

use Library\Model\CountryInterface;
use Library\Model\PlaceInterface;

interface PlaceRepositoryInterface
{
	public function find($id);
	
	public function findByName($name);
	
	public function findByCountry(CountryInterface $country);
	
	public function findByDistrict($district);
	
	public function save(PlaceInterface $place);
}
