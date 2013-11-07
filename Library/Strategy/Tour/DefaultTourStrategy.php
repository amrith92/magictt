<?php

namespace Library\Strategy\Tour;

class DefaultTourStrategy extends AbstractTourStrategy {
		
	public function findAwesomeTours() {
		return $this->tourRepository->findTopTen();
	}
}
