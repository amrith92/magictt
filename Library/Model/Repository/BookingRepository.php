<?php

namespace Library\Model\Repository;

use Library\Model\UserInterface;
use Library\Model\BookingInterface;
use Library\Mapper\BookingMapper;

class BookingRepository implements BookingRepositoryInterface
{
	protected $table = 'bookings';
	protected $bookingMapper;
	
	public function __construct(BookingMapper $bookingMapper)
	{
		$this->bookingMapper = $bookingMapper;
	}
	
	public function find($id) {
		return $this->bookingMapper->findIt($id);
	}
	
	public function findByUser(UserInterface $user) {
		return $this->bookingMapper->findAll(['user' => $user->getId()]);
	}
	
	public function save(BookingInterface $booking) {
		return $this->bookingMapper->save($booking);
	}
}
