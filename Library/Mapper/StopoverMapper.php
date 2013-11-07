<?php

namespace Library\Mapper;

use Library\Database\DatabaseAdapterInterface;
use Library\Model\Stopover;

class StopoverMapper extends AbstractDataMapper {

	protected $table = "stopover";
	protected $pkey = "id";
	protected $placeMapper;
	
	public function __construct(DatabaseAdapterInterface $db, EntityCollectionInterface $collection, PlaceMapper $placeMapper)
	{
		parent::__construct($db, $collection);
		
		$this->placeMapper = $placeMapper;
	}

	protected function createEntity($row) {
		$placeId = $row['place'];
		
		$place = $this->placeMapper->findIt($placeId);
		
		return new Stopover([
			'id' => $row['id'],
			'place' => $place,
			'duration' => (null != $row['duration']) ? $row['duration'] : 0
		]);
	}
}
