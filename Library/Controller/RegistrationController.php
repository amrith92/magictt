<?php

namespace Library\Controller;

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
		$options = [
				'cost' => rand(2, 12)
			];
		$password = \password_hash(\trim($_POST['password']), PASSWORD_BCRYPT, $options);
		$created = \date('Y-m-d h:i:s', \time());
		$dob = \DateTime::createFromFormat('d-m-Y', \filter_var($_POST['dob'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
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
			die ("Password can't be less than 8 characters or more than 70 characters");
		}
		
		$check = $this->getEntityManager()->getRepository('user'); 
		if ($check->findByEmail($email) == null) {
			die ("E-Mail id already exists!");
		}
		
		$user = $this->getEntityManager()->createNew('user');
		$user->setFirstName($firstname);
		$user->setLastName($lastname);
		$user->setEmail($email);
		$user->setgender($gender);
		$user->setPassword($password);
		$user->setCreated($created);
		$user->setDob($dob);
		$repo = $this->getEntityManager()->getRepository('user');
		$repo->save($user);
		$email = $this->getEmail();
		$email->setFrom("Magic TT", "info@magictt.com");
		$email->addRecipient($user->getFullName(),$user->getEmail());
		$email->fillSubject("Welcome to Magic TT");
		$message = "<html><body>";
		$message .= "<p>" . $user->getFullName() ." , </p><br/>";
		$message .= "<p> Welcome to Magic TT. Blah.. Blah.. Blah!!! </p>";
		$email->fillMessage($message);
		$email->send();
		$this->renderView("registration/confirm.php", \compact('user'));
	}
}
