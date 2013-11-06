<?php

namespace Library\Model\Repository;

use Library\Model\CountryInterface;
use Library\Model\PlaceInterface;
use Library\Mapper\PlaceMapper;

class PlaceRepository implements PlaceRepositoryInterface
{
	protected $placeMapper;
	
	public function __construct(PlaceMapper $placeMapper)
	{
		$this->placeMapper = $placeMapper;
	}
	
	public function find($id) {
		return $this->placeMapper->findIt($id);
	}
	
	public function findByName($name) {
		return $this->placeMapper->findAll(['Name' => $name]);
	}
	
	public function findByCountry(CountryInterface $country) {
		return $this->placeMapper->findAll(['Country' => $country->getCode()]);
	}
	
	public function findByDistrict($district) {
		return $this->placeMapper->findAll(['District' => $district]);
	}
	
	public function save(PlaceInterface $place) {
		return $this->placeMapper->save($place);
	}
}
