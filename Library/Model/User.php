<?php 

namespace Library\Model;

class User extends AbstractEntity implements UserInterface {

	protected $allowedFields = [
		'id', 'email', 'password', 'firstName','lastName',
		'dob', 'gender', 'lastUpdated', 'created'
	];
	
	public function setId($id) {
		if (isset($this->fields['id'])) {
			throw new \BadMethodCallException("The ID is already set!");
		}
		
		$id = (int) $id;
		
		if (!\is_int($id) || $id < 1) {
			throw new \InvalidArgumentException("Invalid ID!");
		}
		
		$this->fields['id'] = $id;
		
		return $this;
	}
	
	public function getId() {
		return $this->fields['id'];
	}
	
	public function setEmail($mail) {
		if (!\filter_var($mail, FILTER_VALIDATE_EMAIL)) {
			throw new \InvalidArgumentException("Invalid email id!");
		}
		
		$this->fields['email'] = $mail;
		
		return $this;
	}
	
	public function getEmail() {
		return $this->fields['email'];
	}
	
	public function setPassword($pwd) {
		if (\strlen($pwd) < 8) {
			throw new \InvalidArgumentException("Password is too short!");
		}
		
		$this->fields['password'] = $pwd;
		
		return $this;
	}
	
	public function getPassword() {
		return $this->fields['password'];
	}
	
	public function setFirstName($fname) {
		if(\strlen($fname) < 2) {
			throw new \InvalidArgumentException("Too short for a first name!");
		}
		
		$this->fields['firstName'] = $fname;
		
		return $this;
	}
	
	public function getFirstName() {
		return $this->fields['firstName'];
	}
	
	public function setLastName($lname) {
		if (\strlen($lname) < 1) {
			throw new \InvalidArgumentException("Too short for a last name!");
		}
		
		$this->fields['lastName'] = $lname;
		
		return $this;
	}
	
	public function getLastName() {
		return $this->fields['lastName'];
	}
	
	public function getFullName(){
		return $this->fields['firstName'] . " " . $this->fields['lastName'];
	}
	
	public function setDob($dob) {
		if ($dob instanceof \DateTime) {
			$this->fields['dob'] = $dob;
		} else {
			$theDate = \DateTime::createFromFormat('Y-m-d', $dob);
			$warnings = \DateTime::getLastErrors();
			
			if ($warnings['warning_count'] > 0 || $warnings['error_count'] > 0) {
				throw new \InvalidArgumentException("Date of birth must be in the format YYYY-MM-DD.");
			}
			
			$this->fields['dob'] = $theDate;
		}
		
		return $this;
	}
	
	public function getDob() {
		return $this->fields['dob'];
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
		$sex = \ucfirst(\strtolower($sex));
		
		if (!\in_array($sex, $arr)) {
			throw new \InvalidArgumentException("Invalid Gender!");
		}
		
		$this->fields['gender'] = $sex;
		
		return $this;
	}
	
	public function getLastUpdated() {
		return $this->fields['lastUpdated'];
	}
	
	public function setLastUpdated($last) {
		$theTime = new \DateTime($last);
		$errors = \DateTime::getLastErrors();
		
		if ($errors['error_count'] > 0 || $errors['warning_count'] > 0) {
			throw new \InvalidArgumentException("Invalid Timestamp");
		}
		
		$this->fields['lastUpdated'] = $last;
		
		return $this;
	}
	
	public function setCreated($create) {
		$theTime = new \DateTime($create);
		$errors = \DateTime::getLastErrors();
		
		if ($errors['error_count'] > 0 || $errors['warning_count'] > 0) {
			throw new \InvalidArgumentException("Invalid Timestamp");
		}
		
		$this->fields['created'] = $create;
		
		return $this;
	}
	
	public function getCreated() {
		return $this->fields['created'];
	}
}
