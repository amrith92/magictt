<?php

use Library\Controller;

class RegistrationController extends AbstractController {

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {	
		$this->renderView('registration.php'));
	}
	
	public function submit() {
		$firstname = \filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$lastname = \filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$email = \filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$gender = $_POST['gender'];
		$password = \crypt($_POST['password'],'$2a$07$usesomeMAGICstringforsalt$');
		$created = \date('Y-m-d h:i:s', \time());

		if (\strlen($firstname) < 1) {
			die ("First name can't be empty");
		}
		
		if (\strlen($lastname) < 1) {
			die ("Last name can't be empty'");
		}
		
		if (\strlen($email) < 1) {
			die ("Fill up email!");
		}
		
		if (\strlen($_POST['password']) < 9 || \strlen($_POST['password']) > 70) {
			die ("Password can't be less than 8 characters or more than 70 characters")
		}
	}
}
