<?php

namespace Library\Mapper;

use Library\Model\Country;
use Library\Model\Language;

class CountryMapper extends AbstractDataMapper {

	protected $table = "Country";
	protected $pkey = "Code";

	protected function createEntity(array $row) {
		$rows = $this->query("SELECT * FROM CountryLanguage WHERE CountryCode = {$row['Code']}");
		
		foreach ($rows as $row) {
			$languages = new Language([
				'language' => $row['Language'],
				'isOfficial' => $row['IsOfficial'],
				'percentage' => $row['Percentage']
			]);
		}
		
		$country = new Country([
			'Code' => $row['Code'],
			'Name' => $row['Name'],
			'Continent' => $row['Continent'],
			'Region' => $row['Region'],
			'SurfaceArea' => $row['SurfaceArea'],
			'IndependenceYear' => $row['IndependenceYear'],
			'Population' => $row['Population'],
			'LifeExpectancy' => $row['LifeExpectancy'],
			'Gnp' => $row['Gnp'],
			'GnpOld' => $row['GnpOld'],
			'LocalName' => $row['LocalName'],
			'GovernmentForm' => $row['GovernmentForm'],
			'HeadOfState' => $row['HeadOfState'],
			'Capital' => $row['Capital'],
			'Code2' => $row['Code2']
		]);
		
		$country->setLanguages($languages);
		
		return $country;
	}
}
