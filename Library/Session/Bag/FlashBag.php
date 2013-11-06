<?php

namespace Library\Session\Bag;

class FlashBag extends AbstractBag
{
	protected function attach() {
		if (!isset($_SESSION['FLASH'])) {
			$_SESSION['FLASH'] = [];
		}
		
		$this->bag = &$_SESSION['FLASH'];
	}
}
