<?php

namespace Library\Session\Bag;

class ObjectBag extends AbstractBag
{
	protected function attach() {
		if (!isset($_SESSION['OBJECT'])) {
			$_SESSION['OBJECT'] = [];
		}
		
		$this->bag = &$_SESSION['OBJECT'];
	}
}
