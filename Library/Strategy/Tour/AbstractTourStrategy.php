<?php

namespace Library\Strategy\Tour;

use Library\Mapper\DataMapperInterface;
use Library\Model\Tour;

abstract class AbstractTourStrategy {

	protected $filters = [];
	protected $params = [];
	protected $mapper;
	
	public function __construct(DataMapperInterface $mapper, array $params) {
		$this->mapper = $mapper;
		
		if (!empty($params)) {
			$this->params = $params;
		}
	}
	
	protected function createEntity(array $row) {
		return new Tour([
			'id' => $row['id'],
			'name' => $row['name'],
			'description' => $row['description'],
			'pictureUrl' => $row['pictureUrl'],
			'price' => $row['price'],
			'stopovers'=> $row['stopovers'],
			'category'=> $row['category']
		]);	
	}
	
	protected function createCollection(array $rows) {
		foreach ($rows as $row) {
			$ret[] = $this->createEntity($row);
		}
		
		return $ret;
	}
	
	public abstract function findAwesomeTours() {
		return	$this->mapper->findAll($this->filters);
	}
}

