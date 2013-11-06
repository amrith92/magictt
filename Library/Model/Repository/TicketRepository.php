<?php

namespace Library\Model\Repository;

use Library\Model\TicketInterface;
use Library\Mapper\TicketMapper;

class TicketRepository implements TicketRepositoryInterface
{
	protected $ticketMapper;
	
	public function __construct(TicketMapper $ticketMapper)
	{
		$this->ticketMapper = $ticketMapper;
	}
	
	public function find($id) {
		return $this->ticketMapper->findIt($id);
	}
	
	public function findByName($name) {
		return $this->ticketMapper->findAll(['name' => $name]);
	}
	
	public function save(TicketInterface $ticket) {
		return $this->ticketMapper->save($ticket);
	}
}
