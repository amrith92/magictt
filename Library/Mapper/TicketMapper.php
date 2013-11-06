<?php

namespace Library\Mapper;

use Library\Model\Ticket;

class TicketMapper extends AbstractDataMapper
{
	protected $table = 'ticket';
	
	protected function createEntity(array $row) {
		return new Ticket([
			'id' => $row['id'],
			'name' => $row['name'],
			'dateOfBirth' => $row['dateOfBirth'],
			'gender' => $row['gender'],
			'payable' => $row['payable'],
			'status' => $row['status']
		]);
	}
}
