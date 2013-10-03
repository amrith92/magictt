<?php

namespace Library\Mapper;

class UserMapper extends AbstractDataMapper {

	protected $table = "users";

	protected function createEntity(array $row) {
		return new User([
			'id' => $row['id'],
			'username' => $row['username'],
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
