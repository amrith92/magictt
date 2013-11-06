<?php

namespace Library\Model\Repository;

use Library\Mapper\StopoverMapper;

class StopoverRepository implements StopoverRepositoryInterface
{
	protected $stopoverMapper;
	
	public function __construct(StopoverMapper $stopoverMapper)
	{
		$this->stopoverMapper = $stopoverMapper;
	}

	public function find($id) {
		return $this->stopoverMapper->findIt($id);
	}
	
	public function findByPlace(PlaceInterface $place) {
		return $this->stopoverMapper->findAll(["place" => $place->getId()]);
	}
	
	public function findByDuration($duration) {
		return $this->stopoverMapper->findAll(["duration" => $duration]);
	}
	
	public function save(StopoverInterface $stopover) {
		return $this->stopoverMapper->save($stopover);
	}
}
