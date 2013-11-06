<?php

namespace Library\Strategy\Tour;

class DefaultTourStrategy extends AbstractTourStrategy {
		
	public function findAwesomeTours() {
		return $this->createCollection($this->mapper->query("SELECT * FROM tours ORDER BY views DESC"));
	}
}
