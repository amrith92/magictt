<?php

namespace Library\Mapper;

use Library\Database\DatabaseAdapterInterface;
use Library\Model\Tour;

class TourMapper extends AbstractDataMapper {

	protected $table = "tour";
	protected $stopoverMapper;
	
	public function __construct(DatabaseAdapterInterface $db, EntityCollectionInterface $collection, StopoverMapper $stopoverMapper)
	{
		parent::__construct($db, $collection);
		
		$this->stopoverMapper = $stopoverMapper;
	}

	protected function createEntity($row) {
		$id = $row['id'];
		
		$stopoverIds = $this->query("SELECT stopover_id FROM tour_stopovers WHERE tour_id = {$id}");

		foreach ($stopoverIds as $sid) {
			$ids[] = $sid['stopover_id'];
		}
		
		$collection = $this->stopoverMapper->findInCollection($ids);
		
		$tour = new Tour([
			'id' => $id,
			'name' => $row['name'],
			'description' => $row['description'],
			'pictureUrl' => $row['pictureUrl'],
			'price' => (float) $row['price'],
			'category'=> $row['category'],
			'views' => $row['views']
		]);
		
		return $tour->setStopovers($collection);
	}
}
