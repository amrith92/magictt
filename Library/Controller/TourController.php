<?php

namespace Library\Controller;

use Library\Strategy\Tour\DefaultTourStrategy;
use Library\Strategy\Tour\UserTourStrategy;

class TourController extends AbstractController {

	public function __construct() {
		parent::__construct();
	}
	
	public function index()
	{
		$tourRepo = $this->getEntityManager()->getRepository('Tour');
		
		if (!$this->getSession()->isLoggedIn()) {
			$strategy = new DefaultTourStrategy($tourRepo);
		}	else {
			$strategy = new UserTourStrategy($tourRepo);
		}
		
		$tours = $strategy->findAwesomeTours();
		
		$this->renderView('tour/index.php', \compact('tours'));
	}
}
