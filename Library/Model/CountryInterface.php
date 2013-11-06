<?php

namespace Library\Model;

interface CountryInterface
{
	public function setCode($code);
	
	public function getCode();
	
	public function setName($name);

	public function getName();
	
	public function setContinent($continent);
	
	public function getContinent();
	
	public function setRegion($region);
	
	public function getRegion();
	
	public function setSurfaceArea($area);
	
	public function getSurfaceArea();
	
	public function setIndependenceYear($year);
	
	public function getIndependenceYear();
	
	public function setPopulation($population);
	
	public function getPopulation();
	
	public function setLifeExpectancy($expectancy);
	
	public function getLifeExpectancy();
	
	public function setGnp($gnp);
	
	public function getGnp();
	
	public function setGnpOld($oldGnp);
	
	public function getGnpOld();
	
	public function setLocalName($name);
	
	public function getLocalName();
	
	public function setGovernmentForm($form);
	
	public function getGovernmentForm();
	
	public function setHeadOfState($headOfState);
	
	public function getHeadOfState();
	
	public function setCapital($capital);
	
	public function getCapital();
	
	public function setCode2($code2);
	
	public function getCode2();
	
	public function setLanguages(array $languages);
	
	public function getLanguages();
	
	public function addLanguage(LanguageInterface $language);
	
	public function removeLanguage(LanguageInterface $language);
	
	public function hasLanguage($language);
} 
