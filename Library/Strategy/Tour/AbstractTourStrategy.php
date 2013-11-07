<?php

namespace Library\Strategy\Tour;

use Library\Model\Repository\TourRepository;

abstract class AbstractTourStrategy {

	protected $filters = [];
	protected $tourRepository;

	public function __construct(TourRepository $tourRepository) {
		$this->tourRepository = $tourRepository;
	}
	
	public abstract function findAwesomeTours() {
		return	$this->tourRepository->findAll($this->filters);
	}
}

