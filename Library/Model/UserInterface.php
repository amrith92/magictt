<?php

namespace Library\Model;

interface UserInterface {

	public function getId();
	
	public function setId($id);
	
	public function getEmail();
	
	public function setEmail($mail);
	
	public function getPassword();
	
	public function setPassword($pwd);
	
	public function getFirstname();
	
	public function setFirstname($fname);
	
	public function getLastname();
	
	public function setLastname($lname);
	
	public function getFullname();
	
	public function getDob();
	
	public function setDob(\DateTime $dob);
	
	public function getAge();
	
	public function getGender();
	
	public function setGender($sex);
	
	public function getLastUpdated();
	
	public function setLastUpdated($last);
	
	public function getCreated();
	
	public function setCreated($create);
}
