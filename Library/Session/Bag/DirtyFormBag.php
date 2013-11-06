<?php

namespace Library\Session\Bag;

class DirtyFormBag extends AbstractBag
{
	protected function attach() {
		if (!isset($_SESSION['DIRTYFORM'])) {
			$_SESSION['DIRTYFORM'] = [];
		}
		
		$this->bag = &$_SESSION['DIRTYFORM'];
	}
}
