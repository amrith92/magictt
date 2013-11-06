<?php

namespace Library\Model\Repository;

use Library\Mapper\CountryMapper;
use Library\Model\CountryInterface;

class CountryRepository implements CountryRepositoryInterface
{
	protected $countryMapper;
	
	public function __construct(CountryMapper $countryMapper)
	{
		$this->countryMapper = $countryMapper;
	}
	
	public function find($code) {
		return $this->countryMapper->findIt($code);
	}
	
	public function findByName($name) {
		return $this->countryMapper->findAll(['Name' => $name]);
	}
	
	public function findByContinent($continent) {
		return $this->countryMapper->findAll(['Continent' => $continent]);
	}
	
	public function save(CountryInterface $country) {
		return $this->countryMapper->save($country);
	}
}
