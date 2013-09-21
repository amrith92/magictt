<?php

namespace Library\Model\Places;

interface CountryInterface extends Identifiable {

	public function setCountry($country);

	public function getCountry();
} 
