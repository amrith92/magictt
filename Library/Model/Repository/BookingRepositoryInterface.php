<?php

namespace Library\Model\Repository;

use Library\Model\UserInterface;
use Library\Model\BookingInterface;

interface BookingRepositoryInterface
{
	public function find($id);
	
	public function findByUser(UserInterface $user);
	
	public function save(BookingInterface $booking);
}
