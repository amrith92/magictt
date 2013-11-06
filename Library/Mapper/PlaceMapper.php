<?php

namespace Library\Mapper;

use Library\Model\Place;

class PlaceMapper extends AbstractDataMapper {

	protected $table = "City";
	protected $pkey = "Id";
	protected $countryMapper;
	
	public function __construct(DatabaseAdapterInterface $db, EntityCollectionInterface $collection, CountryMapper $countryMapper) {
		parent::__construct($db, $collection);
		
		$this->countryMapper = $countryMapper;
	}

	protected function createEntity(array $row) {
		$countryId = $row['Country'];
		$country = $this->countryMapper->findIt($countryId);
		
		return new Place([
			'Id' => $row['Id'],
			'Name' => $row['Name'],
			'Country' => $country,
			'District' => $row['District'],
			'Population' => $row['Population']
		]);	
	}
}
