<?php

use Library\Controller;

class RegistrationController extends AbstractController {

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {	
		$this->renderView('registration.php'));
	}

}
