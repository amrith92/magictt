<?php

namespace Library\Model\Repository;

use Library\Model\StopoverInterface;
use Library\Model\PlaceInterface;

interface StopoverRepositoryInterface
{
	public function find($id);
	
	public function findByPlace(PlaceInterface $place);
	
	public function findByDuration($duration);
	
	public function save(StopoverInterface $stopover);
}
