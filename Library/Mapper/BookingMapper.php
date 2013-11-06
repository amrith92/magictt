<?php

namespace Library\Mapper;

use Library\Model\Booking;

class BookingMapper extends AbstractDataMapper
{
	protected $table = 'bookings';
	protected $userMapper;
	protected $tourMapper;
	protected $ticketMapper;
	
	public function __construct(DatabaseAdapterInterface $db, EntityCollectionInterface $collection, UserMapper $userMapper, TourMapper $tourMapper, TicketMapper $ticketMapper)
	{
		parent::__construct($db, $collection);
		
		$this->userMapper = $userMapper;
		$this->tourMapper = $tourMapper;
		$this->ticketMapper = $ticketMapper;
	}
	
	protected function createEntity($row) {
		$user = $this->userMapper->findIt($row['user']);
		$tour = $this->tourMapper->findIt($row['tour']);
		
		$booking = new Booking([
			'id' => $row['id'],
			'user' => $user,
			'tour' => $tour,
			'bookedOn' => $row['bookedOn'],
			'journeyDate' => $row['journeyDate'],
			'status' => $row['status']
		]);
		
		$ticketIds = $this->query("SELECT ticket_id FROM booking_tickets WHERE booking_id = {$row['id']}");
		
		$tickets = $this->ticketMapper->findInCollection($ticketIds);
			
		return $booking->setTickets($tickets);
	}
}
