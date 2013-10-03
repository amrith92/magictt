<?php

namespace Library\Mapper;

use Library\Model\Places;

class PlaceMapper extends AbstractDataMapper {

	protected $table = "cities";

	protected function createEntity(array $row) {
		return new Place([
			'id' => $row['id'],
			'city' => $row['city'],
			'state' => $row['state'],
			'country' => $row['country']
		]);	
	}
}
