<?php

namespace Library\Mapper;

use Library\Model\User;

class UserMapper extends AbstractDataMapper {

	protected $table = "users";

	protected function createEntity($row) {
		return new User([
			'id' => $row['id'],
			'email' => $row['email'],
			'password' => $row['password'],
			'firstName' => $row['firstName'],
			'lastName' => $row['lastName'],
			'dob' => $row['dob'],
			'gender' => $row['gender'],
			'lastUpdated' => $row['lastUpdated'],
			'created' => $row['created']
		]);
	}
}
