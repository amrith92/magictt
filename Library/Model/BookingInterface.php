<?php

namespace Library\Model;

use Library\Model\UserInterface;
use Library\Model\TourInterface;
use Library\Model\TicketInterface;
use Library\Mapper\EntityCollectionInterface;

interface BookingInterface
{
	public function setId($id);
	
	public function getId();
	
	public function setUser(UserInterface $user);
	
	public function getUser();
	
	public function setTour(TourInterface $tour);
	
	public function getTour();
	
	public function setBookedOn($bookedOn);
	
	public function getBookedOn();
	
	public function setJourneyDate($journeyDate);
	
	public function getJourneyDate();
	
	public function setStatus($status);
	
	public function getStatus();
	
	public function setTickets(EntityCollectionInterface $tickets);
	
	public function getTickets();
	
	public function addTicket(TicketInterface $ticket);
	
	public function removeTicket(TicketInterface $ticket);
	
	public function hasTicket(TicketInterface $ticket);
}
