<?php

namespace Library\Controller;

class RegistrationController extends AbstractController {

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {	
		$this->renderView('registration/index.php');
	}
	
	public function submit() {
		$firstname = \filter_var($_POST['firstName'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$lastname = \filter_var($_POST['lastName'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$email = \filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$gender = \filter_var($_POST['gender'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		
		$options = [
			'cost' => rand(2, 12)
		];
		
		$password = \password_hash(\trim($_POST['password']), PASSWORD_BCRYPT, $options);
		$created = \date('Y-m-d h:i:s', \time());
		$dob = \DateTime::createFromFormat('d-m-Y', \filter_var($_POST['dob'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
		
		if (\strlen($firstname) < 1) {
			$this->respond(400, "First name can't be empty");
		}
		
		if (\strlen($lastname) < 1) {
			$this->respond(400, "Last name can't be empty'");
		}
		
		if (\strlen($email) < 1) {
			$this->respond(400, "Fill up email!");
		}
		
		if (\strlen($_POST['password']) < 9 || \strlen($_POST['password']) > 70) {
			$this->respond(400, "Password can't be less than 8 characters or more than 70 characters");
		}
		
		$userRepository = $this->getEntityManager()->getRepository('User');
		
		$check = $userRepository->findByEmail($email);
		
		if (null != $check) {
			$this->respond(400, "E-Mail id already exists!");
		}
		
		$user = $this->getEntityManager()->createNew('User', [
			'firstName' => $firstname,
			'lastName' => $lastname,
			'email' => $email,
			'gender' => $gender,
			'password' => $password,
			'created' => $created,
			'dob' => $dob
		]);
		
		$userRepository->save($user);
		
		$email = $this->getEmail();
		$email->setFrom("Magic TT", "info@magictt.com");
		$email->addRecipient($user->getFullName(), $user->getEmail());
		$email->fillSubject("Welcome to Magic TT");
		$message = "<html><body>";
		$message .= "<p>" . $user->getFullName() ." , </p><br/>";
		$message .= "<p> Welcome to Magic TT. Blah.. Blah.. Blah!!! </p>";
		$email->fillMessage($message);
		$email->send();
		
		$this->renderView("registration/thankyou.php");
	}
}
