<?php

namespace Library\Mapper;

use Library\Model\Places;

class CountryMapper extends AbstractDataMapper {

	protected $table = "countries";

	protected function createEntity(array $row) {
		return new Country([
			'id' => $row['id'],
			'country' => $row['country']
		]);	
	}
}
