<?php

namespace Library\Strategy\Tour;

use Library\Model\Repository\TourRepository;

abstract class AbstractTourStrategy {

	protected $params = [];
	protected $tourRepository;

	public function __construct(TourRepository $tourRepository, array $params = array()) {
		$this->tourRepository = $tourRepository;
		$this->params = $params;
	}
	
	abstract public function findAwesomeTours();
}

