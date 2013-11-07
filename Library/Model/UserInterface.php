<?php

namespace Library\Model;

interface UserInterface {
	
	public function getEmail();
	
	public function setEmail($mail);
	
	public function getPassword();
	
	public function setPassword($pwd);
	
	public function getFirstName();
	
	public function setFirstName($fname);
	
	public function getLastName();
	
	public function setLastName($lname);
	
	public function getFullName();
	
	public function getDob();
	
	public function setDob($dob);
	
	public function getAge();
	
	public function getGender();
	
	public function setGender($sex);
	
	public function getLastUpdated();
	
	public function setLastUpdated($last);
	
	public function getCreated();
	
	public function setCreated($create);
}
