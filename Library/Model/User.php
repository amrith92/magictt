<?php 

namespace Library\Model;

class User implements UserInterface {

	private $id;
	private $email;
	private $password;
	private $firstname;
	private $lastname;
	private $dob;
	private $gender;
	private $lastUpdated;
	private $created;
	
	public function __construct(array $fields) {
		foreach ($fields as $field => $value) {
			$fn = 'set' . \ucfirst($field);
			$this->$fn($value);
		}
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function setId($id) {
		if (isset($this->id)) {
			throw new \BadMethodCallException("The ID is already set!");
		}
		if (!\is_int($id) || $id < 1) {
			throw new \InvalidArgumentException("Invalid ID!");
		}
		else {
			$this->id = $id;
		}
	}
	
	public function getEmail() {
		return $this->email;
	}
	
	public function setEmail($mail) {
		
		if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
			$this->email = $mail;
		}
		else {
			throw new \InvalidArgumentException("Invalid email id!"); 
		}
	}
	
	public function getPassword() {
		return $this->password;
	}
	
	public function setPassword($pwd) {
		
		if (\strlen($pwd) > 8) {
			$this->password = $pwd;
		}
		else {
			throw new \InvalidArgumentException("Password is too short!");
		}
	}
	
	public function getFirstname() {
		return $this->firstname;
	}
	
	public function setFirstname($fname) {
		
		if(\strlen($fname) > 2) {
			$this->firstname = $fname;
		}
		else {
			throw new \InvalidArgumentException("Too short for a first name!");
		}
	}
	
	public function getLastname() {
		return $this->lastname;
	}
	
	public function setLastname($lname) {
		if (\strlen($lname) > 0) {
			$this->lastname = $lname;
		}
		else {
			throw new \InvalidArgumentException("Too short for a last name!");
		}
	}
	
	public function getFullName(){
		return $this->firstname . " " . $this->lastname;
	}
	
	public function getDob() {
		return $this->dob;
	}
	
	public function setDob(\DateTime $dob) {
		$theDate = \DateTime::createFromFormat('Y-m-d', $dob->format('Y-m-d'));
		$errors = \DateTime::getLastErrors();
		
		if ($errors['error_count'] > 0 || $errors['warning_count'] > 0) {
			throw new \InvalidArgumentException("Invalid date of birth!");
		}
		
		$this->dob = $dob;
	}
	
	public function getAge() {
		$date = new \DateTime();
		$diff = $date->diff($this->dob);
		
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
		
		$this->gender = $sex;
	}
	
	public function getLastUpdated() {
		return $this->lastUpdated;
	}
	
	public function setLastUpdated($last) {
		$theTime = new \DateTime($last);
		$errors = \DateTime::getLastErrors();
		
		if ($errors['error_count'] > 0 || $errors['warning_error'] > 0) {
			throw new \InvalidArgumentException("Invalid Timestamp");
		}
		
		$this->lastUpdated = $last;
	}
	
	public function getCreated() {
		return $this->created;
	}
	
	public function setCreated($create) {
		$theTime = new \DateTime($create);
		$errors = \DateTime::getLastErrors();
		
		if ($errors['error_count'] > 0 || $errors['warning_error'] > 0) {
			throw new \InvalidArgumentException("Invalid Timestamp");
		}
		
		$this->created = $create;
	}
}

