<?php

namespace Library\Model;

class Country extends AbstractEntity implements CountryInterface
{	
	protected $allowedFields = [ 
		'Code', 'Name', 'Continent', 'Region', 'SurfaceArea',
		'IndependenceYear', 'Population', 'LifeExpectancy', 'Gnp',
		'GnpOld', 'LocalName', 'GovernmentForm', 'HeadOfState',
		'Capital', 'Code2'
	];
	
	protected $languages;
	
	public function setId($id) {
		return $this->setCode($id);
	}
	
	public function getId() {
		return $this->getCode();
	}
	
	public function setCode($code) {
		if (isset($this->fields['Code'])) {
			throw new \BadMethodCallException("Country code already set!");
		}
		
		if (\strlen($code) > 3) {
			throw new \InvalidArgumentException("Country code cannot be longer than three characters!");
		}
		
		$this->fields['Code'] = $code;
		
		return $this;
	}
	
	public function getCode() {
		return $this->fields['Code'];
	}
	
	public function setName($name) {
		if (\strlen($name) < 2) {
			throw new \InvalidArgumentException("Country name must be longer than 2 characters.");
		}
		
		$this->fields['Name'] = $name;
		
		return $this;
	}

	public function getName() {
		return $this->fields['Name'];
	}
	
	public function setContinent($continent) {
		$validContinents = [
			'Asia', 'Europe', 'North America', 'Africa', 'Oceania',
			'Antartica', 'South America'
		];
		
		if (!\in_array($continent, $validContinents)) {
			throw new \InvalidArgumentException("Not a valid continent.");
		}
		
		$this->fields['Continent'] = $continent;
		
		return $this;
	}
	
	public function getContinent() {
		return $this->fields['Continent'];
	}
	
	public function setRegion($region) {
		if (\strlen($region) > 26) {
			throw new \InvalidArgumentException("Region name too long.");
		}
		
		if (\strlen($region) < 2) {
			throw new \InvalidArgumenException("Region name too short.");
		}
		
		$this->fields['Region'] = $region;
		
		return $this;
	}
	
	public function getRegion() {
		return $this->fields['Region'];
	}
	
	public function setSurfaceArea($area) {
		$area = (float) $area;
		
		if (!\is_float($area)) {
			throw new \InvalidArgumentException("Area must be a float.");
		}
		
		$this->fields['SurfaceArea'] = $area;
		
		return $this;
	}
	
	public function getSurfaceArea() {
		return $this->fields['SurfaceArea'];
	}
	
	public function setIndependenceYear($year) {
		$year = (int) $year;
		
		if (!\is_int($year)) {
			throw new \InvalidArgumentException("Year must be, well, a year.");
		}
		
		$this->fields['IndependenceYear'] = $year;
		
		return $this;
	}
	
	public function getIndependenceYear() {
		return $this->fields['IndependenceYear'];
	}
	
	public function setPopulation($population) {
		$this->fields['Population'] = $population;
		
		return $this;
	}
	
	public function getPopulation() {
		return $this->fields['Population'];
	}
	
	public function setLifeExpectancy($expectancy) {
		$expectancy = (float) $expectancy;
		
		if (!\is_float($expectancy)) {
			throw new \InvalidArgumentException("Life expectancy must be a number.");
		}
		
		$this->fields['LifeExpectancy'] = $expectancy;
		
		return $this;
	}
	
	public function getLifeExpectancy() {
		return $this->fields['LifeExpectancy'];
	}
	
	public function setGnp($gnp) {
		$gnp = (float) $gnp;
		
		if (!\is_float($gnp)) {
			throw new \InvalidArgumentException("GNP must be a number.");
		}
		
		$this->fields['Gnp'] = $gnp;
		
		return $this;
	}
	
	public function getGnp() {
		return $this->fields['Gnp'];
	}
	
	public function setGnpOld($oldGnp) {
		$oldGnp = (float) $oldGnp;
		
		if (!\is_float($oldGnp)) {
			throw new \InvalidArgumentException("GNP must be a number.");
		}
		
		$this->fields['GnpOld'] = $oldGnp;
		
		return $this;
	}
	
	public function getGnpOld() {
		return $this->fields['GnpOld'];
	}
	
	public function setLocalName($name) {
		if (\strlen($name) < 2) {
			throw new \InvalidArgumentException("Local name too short.");
		}
		
		$this->fields['LocalName'] = $name;
		
		return $this;
	}
	
	public function getLocalName() {
		return $this->fields['LocalName'];
	}
	
	public function setGovernmentForm($form) {
		$this->fields['GovernmentForm'] = $form;
		
		return $this;
	}
	
	public function getGovernmentForm() {
		return $this->fields['GovernmentForm'];
	}
	
	public function setHeadOfState($headOfState) {
		$this->fields['HeadOfState'] = $headOfState;
		
		return $this;
	}
	
	public function getHeadOfState() {
		return $this->fields['HeadOfState'];
	}
	
	public function setCapital($capital) {
		$this->fields['Capital'] = $capital;
		
		return $this;
	}
	
	public function getCapital() {
		return $this->fields['Capital'];
	}
	
	public function setCode2($code2) {
		if (\strlen($code2) > 2) {
			throw new \InvalidArgumentException("Code must be longer than 2 characters.");
		}
		
		$this->fields['Code2'] = $code2;
		
		return $this;
	}
	
	public function getCode2() {
		return $this->fields['Code2'];
	}
	
	public function setLanguages(array $languages)
	{
		$this->languages = $languages;
		
		return $this;
	}
	
	public function getLanguages() {
		return $this->languages;
	}
	
	public function addLanguage(LanguageInterface $language) {
		if (\in_array($language, $this->languages)) {
			throw new \BadMethodCallException("Language already associated with country.");
		}
		
		$this->languages[] = $language;
		
		return $this;
	}
	
	public function removeLanguage(LanguageInterface $language) {
		if (!\in_array($language, $this->languages)) {
			throw new \BadMethodCallException("Language not associated with country.");
		}
		
		foreach ($this->languages as $k => $lang) {
			if ($lang == $language) {
				unset($this->languages[$k]);
			}
		}
		
		return $this;
	}
	
	public function hasLanguage($language) {
		return \in_array($language, $this->languages);
	}
}
