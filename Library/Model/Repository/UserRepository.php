<?php

namespace Library\Model\Repository;

use Library\Model\UserInterface;

class UserRepository implements UserRepositoryInterface
{
	protected $userMapper;
	
	public function __construct(UserMapper $userMapper) {
		$this->userMapper = $userMapper;
	}
	
	public function find($id) {
		return $this->userMapper->findIt($id);
	}
	
	public function findByEmail($email) {
		return $this->userMapper->findAll(['email' => $email]);
	}
	
	public function findByFirstName($firstName) {
		return $this->userMapper->findAll(['firstName' => $firstName]);
	}
	
	public function findByLastName($lastName) {
		return $this->userMapper->findAll(['lastName' => $lastName]);
	}
	
	public function findByDob($dob) {
		return $this->userMapper->findAll(['dob' => $dob]);
	}
	
	public function save(UserInterface $user) {
		return $this->userMapper->save($user);
	}
}
