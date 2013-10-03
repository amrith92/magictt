<?php

namespace Library\Controller;

class IndexController extends AbstractController {

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$this->renderView('index.php');
	}
}

