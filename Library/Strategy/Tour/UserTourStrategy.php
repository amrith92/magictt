<?php

namespace Library\Strategy\Tour;

class UserTourStrategy extends AbstractTourStrategy {

	public function findAwesomeTours() {
		if (isset($this->params['age'])) {
			$age = $this->params['age'];
		} else {
			$age = 35;
		}
		
		$sql = "SELECT * FROM tours WHERE category = ";
		
		if ($age <= 20) {
			$sql .= "1";
		} else if ($age <= 35) {
			$sql .= "2";
		} else if ($age <= 55) {
			$sql .= "3";
		} else {
			$sql .= '4';
		}
		
		return $this->createCollection($this->mapper->query($sql));
	}
}
