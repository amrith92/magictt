<?php

namespace Library\Mapper;

use Library\Model\Places;

class StateMapper extends AbstractDataMapper {

	protected $table = "states";

	protected function createEntity(array $row) {
		return new State([
			'id' => $row['id'],
			'state' => $row['state']
		]);	
	}
}
