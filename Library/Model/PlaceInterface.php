<?php

namespace Library\Model;

interface PlaceInterface extends Identifiable
{
	public function setName($name);
	
	public function getName();
	
	public function setCountry(CountryInterface $country);
	
	public function getCountry();
	
	public function setDistrict($district);
	
	public function getDistrict();
	
	public function setPopulation($population);
	
	public function getPopulation();
} 
