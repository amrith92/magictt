<?php

namespace Library\Model;

class Ticket extends AbstractEntity implements TicketInterface
{
	protected $allowedFields = [
		'id', 'name', 'dateOfBirth',
		'gender', 'payable', 'status'
	];
	
	public function setId($id) {
		if (isset($this->id)) {
			throw new \BadMethodCallException("ID already set for this ticket.");
		}
		
		$id = (int) $id;
		
		if (!is_int($id)) {
			throw new \InvalidArgumentException("ID must be an integer.");
		}
		
		$this->fields['id'] = $id;
		
		return $this;
	}
	
	public function getId() {
		return $this->fields['id'];
	}
	
	public function setName($name) {
		if (\strlen($name) < 2) {
			throw new \InvalidArgumentException("Please enter a valid name!");
		}
		
		$this->fields['name'] = $name;
		
		return $this;
	}
	
	public function getName() {
		return $this->fields['name'];
	}
	
	public function setDateOfBirth($dateOfBirth) {
		if ($dateOfBirth instanceof \DateTime) {
			$this->fields['dateOfBirth'] = $dateOfBirth;
		} else {
			$dob = \DateTime::createFromFormat('Y-m-d', $dateOfBirth);
			$warnings = \DateTime::getLastErrors();
			
			if ($warnings->warning_count > 0 || $warnings->error_count > 0) {
				throw new \InvalidArgumentException("Date must be in the format YYYY-MM-DD.");
			}
			
			$this->fields['dateOfBirth'] = $dob;
		}
		
		return $this;
	}
	
	public function getDateOfBirth() {
		return $this->fields['dateOfBirth'];
	}
	
	public function setGender($gender) {
		$valid_genders = ['Male', 'Female'];
		$gender = \ucfirst(\strtolower($gender));
		
		if (!\in_array($gender, $valid_genders)) {
			throw new \InvalidArgumentException("Gender must be either male or female. Others, please contact desk.");
		}
		
		$this->fields['gender'] = $gender;
		
		return $this;
	}
	
	public function getGender() {
		return $this->fields['gender'];
	}
	
	public function setPayable($payable) {
		$payable = (float) $payable;
		
		if (!\is_float($payable)) {
			throw new \InvalidArgumentException("Amount must be a number.");
		}
		
		$this->fields['payable'] = $payable;
		
		return $this;
	}
	
	public function getPayable() {
		return $this->fields['payable'];
	}
	
	public function setStatus($status) {
		$valid_status = [
			'Paid', 'Cancelled', 'Discounted', 'Invalid'
		];
		
		$status = \ucfirst(\strtolower($status));
		
		if (!\in_array($status, $valid_status)) {
			throw new \InvalidArgumentException(\sprintf("Status must be one of {%s}", \implode(', ', $valid_status)));
		}
		
		$this->fields['status'] = $status;
		
		return $this;
	}
	
	public function getStatus() {
		return $this->fields['status'];
	}
}
