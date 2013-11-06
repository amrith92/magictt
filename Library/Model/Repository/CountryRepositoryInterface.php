<?php

namespace Library\Model\Repository;

use Library\Model\CountryInterface;

interface CountryRepositoryInterface
{
	public function find($code);
	
	public function findByName($name);
	
	public function findByContinent($continent);
	
	public function save(CountryInterface $country);
}
