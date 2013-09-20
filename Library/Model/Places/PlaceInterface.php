<?php

namespace Library\Model\Places;

interface PlaceInterface {

	public function setId($id);

	public function getId();

	public function setCity($city);

	public function getCity();

	public function getState();

	public function setState(\State $state);
	
	public function getCountry();
	
	public function setCountry(\Country $country);
} 
