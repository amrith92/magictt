<?php

namespace Library\Model;

use Library\Model\UserInterface;
use Library\Model\TourInterface;
use Library\Model\TicketInterface;
use Library\Mapper\EntityCollectionInterface;

class Booking extends AbstractEntity implements BookingInterface
{
	protected $allowedFields = [
		'id', 'user', 'tour', 'bookedOn',
		'journeyDate', 'status'
	];
	
	protected $tickets;
	
	public function setId($id) {
		if (!isset($this->fields['id'])) {
			throw new \InvalidArgumentException("ID is already set.");
		}
		
		$id = (int) $id;
		
		if (!\is_int($id)) {
			throw new \InvalidArgumentException("ID must be an integer.");
		}
		
		$this->fields['id'] = $id;
		
		return $this;
	}
	
	public function getId() {
		return $this->fields['id'];
	}
	
	public function setUser(UserInterface $user) {
		$this->fields['user'] = $user;
		
		return $this;
	}
	
	public function getUser() {
		return $this->fields['user'];
	}
	
	public function setTour(TourInterface $tour) {
		$this->fields['tour'] = $tour;
		
		return $this;
	}
	
	public function getTour() {
		return $this->fields['tour'];
	}
	
	public function setBookedOn($bookedOn) {
		if ($bookedOn instanceof \DateTime) {
			$this->fields['bookedOn'] = $bookedOn;
		} else {
			$date = \DateTime::createFromFormat('Y-m-d', $bookedOn);
			
			$warnings = \DateTime::getLastErrors();
			
			if ($warnings->warning_count > 0 || $warnings->error_count > 0) {
				throw new \InvalidArgumentException("Date must be in the format YYYY-MM-DD.");
			}
			
			$this->fields['bookedOn'] = $date;
		}
		
		return $this;
	}
	
	public function getBookedOn() {
		return $this->fields['bookedOn'];
	}
	
	public function setJourneyDate($journeyDate) {
		if ($journeyDate instanceof \DateTime) {
			$this->fields['journeyDate'] = $journeyDate;
		} else {
			$date = \DateTime::createFromFormat('Y-m-d', $journeyDate);
			
			$warnings = \DateTime::getLastErrors();
			
			if ($warnings->warning_count > 0 || $warnings->error_count > 0) {
				throw new \InvalidArgumentException("Date must be in the format YYYY-MM-DD.");
			}
			
			$this->fields['journeyDate'] = $date;
		}
		
		return $this;
	}
	
	public function getJourneyDate() {
		return $this->fields['journeyDate'];
	}
	
	public function setStatus($status) {
		$valid_status = [
			'Confirmed', 'Cancelled', 'Invalid'
		];
		
		$status = \ucfirst(\strtolower($status));
		
		if (!\in_array($status, $valid_status)) {
			throw new \InvalidArgumentException(\sprintf("Status not valid. Valid ones are {%s}", \implode(', ', $valid_status)));
		}
		
		$this->fields['status'] = $status;
		
		return $this;
	}
	
	public function getStatus() {
		return $this->fields['status'];
	}
	
	public function setTickets(EntityCollectionInterface $tickets) {
		$this->tickets = $tickets;
		
		return $this;
	}
	
	public function getTickets() {
		return $this->tickets;
	}
	
	public function addTicket(TicketInterface $ticket) {
		foreach ($this->tickets as $t) {
			if ($t->getId() == $ticket->getId()) {
				throw new \BadMethodCallException("Ticket already associated with this booking.");
			}
		}
		
		$this->tickets[] = $ticket;
		
		return $this;
	}
	
	public function removeTicket(TicketInterface $ticket) {
		foreach ($this->tickets as $k => $t) {
			if ($t->getId() == $ticket->getId()) {
				unset($this->tickets[$k]);
				
				return $this;
			}
		}
		
		throw new \BadMethodCallException("Ticket not associated with this booking.");
	}
	
	public function hasTicket(TicketInterface $ticket) {
		foreach ($this->tickets as $k => $t) {
			if ($t->getId() == $ticket->getId()) {
				return true;
			}
		}
		
		return false;
	}
}
