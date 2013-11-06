<?php

namespace Library\Model\Repository;

use Library\Model\UserInterface;

interface UserRepositoryInterface
{
	public function find($id);
	
	public function findByEmail($email);
	
	public function findByFirstName($firstName);
	
	public function findByLastName($lastName);
	
	public function findByDob($dob);
	
	public function save(UserInterface $user);
}
