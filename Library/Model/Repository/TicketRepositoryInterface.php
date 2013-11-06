<?php

namespace Library\Model\Repository;

use Library\Model\TicketInterface;

interface TicketRepositoryInterface
{
	public function find($id);
	
	public function findByName($name);
	
	public function save(TicketInterface $ticket);
}
