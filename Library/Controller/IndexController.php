<?php

namespace Library\Controller;

class IndexController extends AbstractController {

	public function __construct() {
		parent::__construct();
	}
	
	public function index(array $forms_arr = array()) {	
		if (isset($forms_arr['registration'])) {
			$forms['registration'] = $forms_arr['registration'];
		} 
		if (isset($forms_arr['login'])) {
			$forms['login'] = $forms_arr['login'];
		} 

		$this->renderView('index.php',\compact('forms')));
	}
}
