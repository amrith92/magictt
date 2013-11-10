<?php

namespace Library\Strategy\Tour;

class UserTourStrategy extends AbstractTourStrategy {

	public function findAwesomeTours() {
		if (isset($this->params['age'])) {
			$age = $this->params['age'];
		} else {
			$age = 35;
		}
		
		if ($age <= 20) {
			$category = '1';
		} else if ($age <= 35) {
			$category = '2';
		} else if ($age <= 55) {
			$category = '3';
		} else {
			$category = '4';
		}
		
		if (isset($this->params['married'])) {
			if ('Yes' == $this->params['married']) {
				if ($category != '3' && $category != '4') {
					$category = '4';
				}
			}
		}
		
		if (isset($this->params['kids'])) {
			if ('Yes' == $this->params['kids']) {
				if ($category != '1' && $category != '2') {
					$category = '1';
				}
			}
		}
		
		return $this->tourRepository->findByCategory($category);
	}
}
