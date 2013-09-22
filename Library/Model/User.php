<?php 

namespace Library\Model;

class User extends AbstractEntity implements UserInterface {

	protected $allowedFields = [
		'id', 'email', 'password', 'firstname','lastname',
		'dob', 'gender', 'lastUpdated', 'created'
	];	
	
	public function getId() {
		return $this->fields['id'];
	}
	
	public function setId($id) {
		if (isset($this->fields['id'])) {
			throw new \BadMethodCallException("The ID is already set!");
		}
		if (!\is_int($id) || $id < 1) {
			throw new \InvalidArgumentException("Invalid ID!");
		}
		else {
			$this->fields['id'] = $id;
		}
	}
	
	public function getEmail() {
		return $this->fields['email'];
	}
	
	public function setEmail($mail) {
		
		if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
			$this->fields['email'] = $mail;
		}
		else {
			throw new \InvalidArgumentException("Invalid email id!"); 
		}
	}
	
	public function getPassword() {
		return $this->fields['password'];
	}
	
	public function setPassword($pwd) {
		
		if (\strlen($pwd) > 8) {
			$this->fields['password'] = $pwd;
		}
		else {
			throw new \InvalidArgumentException("Password is too short!");
		}
	}
	
	public function getFirstname() {
		return $this->fields['firstname'];
	}
	
	public function setFirstname($fname) {
		
		if(\strlen($fname) > 2) {
			$this->fields['firstname'] = $fname;
		}
		else {
			throw new \InvalidArgumentException("Too short for a first name!");
		}
	}
	
	public function getLastname() {
		return $this->fields['lastname'];
	}
	
	public function setLastname($lname) {
		if (\strlen($lname) > 0) {
			$this->fields['lastname'] = $lname;
		}
		else {
			throw new \InvalidArgumentException("Too short for a last name!");
		}
	}
	
	public function getFullName(){
		return $this->fields['firstname'] . " " . $this->fields['lastname'];
	}
	
	public function getDob() {
		return $this->fields['dob'];
	}
	
	public function setDob(\DateTime $dob) {
		$theDate = \DateTime::createFromFormat('Y-m-d', $dob->format('Y-m-d'));
		$errors = \DateTime::getLastErrors();
		
		if ($errors['error_count'] > 0 || $errors['warning_count'] > 0) {
			throw new \InvalidArgumentException("Invalid date of birth!");
		}
		
		$this->fields['dob'] = $dob;
	}
	
	public function getAge() {
		$date = new \DateTime();
		$diff = $date->diff($this->fields['dob']);
		
		return $diff->y;
	}
	public function getGender() {
		return $this->gender;
	}
	
	public function setGender($sex) {
		$arr = ['Male', 'Female', 'Other'];
		$sex = \ucfirst($sex);
		
		if (!\in_array($sex, $arr)) {
			throw new \InvalidArgumentException("Invalid Gender!");
		}
		
		$this->fields['gender'] = $sex;
	}
	
	public function getLastUpdated() {
		return $this->fields['lastUpdated'];
	}
	
	public function setLastUpdated($last) {
		$theTime = new \DateTime($last);
		$errors = \DateTime::getLastErrors();
		
		if ($errors['error_count'] > 0 || $errors['warning_error'] > 0) {
			throw new \InvalidArgumentException("Invalid Timestamp");
		}
		
		$this->fields['lastUpdated'] = $last;
	}
	
	public function getCreated() {
		return $this->fields['created'];
	}
	
	public function setCreated($create) {
		$theTime = new \DateTime($create);
		$errors = \DateTime::getLastErrors();
		
		if ($errors['error_count'] > 0 || $errors['warning_error'] > 0) {
			throw new \InvalidArgumentException("Invalid Timestamp");
		}
		
		$this->fields['created'] = $create;
	}
}

