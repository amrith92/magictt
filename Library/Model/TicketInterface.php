<?php

namespace Library\Model;

interface TicketInterface
{
	public function setId($id);
	
	public function getId();
	
	public function setName($name);
	
	public function getName();
	
	public function setDateOfBirth($dateOfBirth);
	
	public function getDateOfBirth();
	
	public function setGender($gender);
	
	public function getGender();
	
	public function setPayable($payable);
	
	public function getPayable();
	
	public function setStatus($status);
	
	public function getStatus();
}
