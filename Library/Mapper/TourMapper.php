<?php

namespace Library\Mapper;

use Library\Model\Tour;

class TourMapper extends AbstractDataMapper {

	protected $table = "tour";
	protected $stopoverMapper;
	
	public function __construct(DatabaseAdapterInterface $db, EntityCollectionInterface $collection, StopoverMapper $stopoverMapper)
	{
		parent::__construct($db, $collection);
		
		$this->stopoverMapper = $stopoverMapper;
	}

	protected function createEntity(array $row) {
		$id = $row['id'];
		
		$stopoverIds = $this->query("SELECT stopover_id FROM tour_stopovers WHERE {$this->pkey} = {$id}");
		$collection = $this->stopoverMapper->findInCollection($stopoverIds);
		
		return new Tour([
			'id' => $id,
			'name' => $row['name'],
			'description' => $row['description'],
			'pictureUrl' => $row['pictureUrl'],
			'price' => $row['price'],
			'stopovers'=> $collection,
			'category'=> $row['category'],
			'views' => $row['views']
		]);
	}
}
