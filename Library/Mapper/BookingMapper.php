<?php

namespace Library\Mapper;

use Library\Database\DatabaseAdapterInterface;
use Library\Model\EntityInterface;
use Library\Model\UserInterface;
use Library\Model\TourInterface;
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
	
	public function save(EntityInterface $entity) {
		$values = $entity->toArray();
		
		foreach ($values as $k => $value) {
			if ($value instanceof UserInterface) {
				$values[$k] = $value->getId();
			}
			
			if ($value instanceof TourInterface) {
				$values[$k] = $value->getId();
			}
		}
		
		!isset($entity->id)
			? $this->db->insert($this->table, $values)
			: $this->db->update($this->table, $values);
		
		$lastInsertId = $this->db->getLastInsertId();
		
		if (0 != $lastInsertId) {
			$fn = 'set' . \ucfirst($this->pkey);
			$entity->$fn($lastInsertId);
		}
	}
}
