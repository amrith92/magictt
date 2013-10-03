<?php

namespace Library\Mapper;

use Library\Model;

class StopoverMapper extends AbstractDataMapper {

	protected $table = "stopover";

	protected function createEntity(array $row) {
		return new Stopover([
			'id' => $row['id'],
			'place' => $row['name'],
			'duration' => $row['duration'],
			'tours' => $row['tous']
		]);	
	}
}
