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
		
		if (!$this->getSession()->isLoggedIn() && !isset($_GET['age'])) {
			$strategy = new DefaultTourStrategy($tourRepo);
		}	else {
			$params = [];
			
			if (isset($_GET['age'])) {
				$params['age'] = \filter_var($_GET['age'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			}
			
			if (isset($_GET['married'])) {
				$params['married'] = \filter_var($_GET['married'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			}
			
			if (isset($_GET['kids'])) {
				$params['kids'] = \filter_var($_GET['kids'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			}
			
			$strategy = new UserTourStrategy($tourRepo, $params);
		}
		
		$tours = $strategy->findAwesomeTours();
		
		$this->renderView('tour/index.php', \compact('tours'));
	}
	
	public function show($id) {
		$tourRepo = $this->getEntityManager()->getRepository('Tour');
		
		$tour = $tourRepo->find($id);
		
		if ($tour == null) {
			$this->renderView('404.php');
			exit();
		}
		
		$this->renderView('tour/show.php', \compact('tour'));
	}
}
