<?php

namespace Library\Mapper;

use Library\Model;

class TourMapper extends AbstractDataMapper {

	protected $table = "tour";

	protected function createEntity(array $row) {
		return new Tour([
			'id' => $row['id'],
			'name' => $row['name'],
			'description' => $row['description'],
			'pictureUrl' => $row['pictureUrl'],
			'price' => $row['price'],
			'stopovers'=> $row['stopovers']
		]);	
	}
}
