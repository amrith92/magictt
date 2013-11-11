<?php

namespace Library\Controller;

class AuthController extends AbstractController
{
	public function __construct() {
		parent::__construct();
	}
	
	public function book($tourId)
	{
		$session = $this->getSession();
		
		if ($session->isLoggedIn()) {
			$this->forward(\sprintf("/booking/tour/%d", $tourId));
		}
		
		$tour = $this->getEntityManager()->getRepository('Tour')->find($tourId);
		
		$session->getObjectBag()->add('auth_booking_tour', $tour);
		
		$this->renderView('auth/index.php', \compact('tour'));
	}
	
	public function login()
	{
		$username = \filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$password = \filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		
		$user = $this->getEntityManager()->getRepository('User')->findByEmail($username);
		
		if (null == $user) {
			$this->respond(400, 'Invalid username or password.');
		}
		
		if (\password_verify($password, $user->getPassword())) {
			$session = $this->getSession();
			$session->setUserId($user->getId());
			$session->getObjectBag()->add('user', $user);
			$session->getFlashBag()->add('success', 'Successfully logged in!');
	
			$tour = $session->getObjectBag()->get('auth_booking_tour');
			
			$this->forward(\sprintf("/booking/tour/%d", $tour->getId()));
		}
		
		$this->respond(400, 'Invalid username or password. Go Fish.');
	}
	
	public function register()
	{
		$fields['firstName'] = \filter_var($_POST['firstName'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$fields['lastName'] = \filter_var($_POST['lastName'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$fields['email'] = \filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$fields['password'] = \filter_var($_POST['regpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$fields['dob'] = \filter_var($_POST['dob'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$fields['gender'] = \filter_var($_POST['gender'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		
		$fields['dob'] = \DateTime::createFromFormat('d-m-Y', $fields['dob']);
		
		$options = [
			'cost' => \rand(2, 12)
		];
		
		$fields['password'] = \password_hash(\trim($fields['password']), PASSWORD_BCRYPT, $options);
		
		$em = $this->getEntityManager();
		
		try {
			$user = $em->createNew('User', $fields);
			$em->getRepository('User')->save($user);
		} catch (\Exception $e) {
			$this->respond(400, $e->getMessage());
		}
		
		$session = $this->getSession();
		$session->getFlashBag()->add('success', 'Successfully registered!');
		
		$tour = $session->getObjectBag()->get('auth_booking_tour');
		$this->forward(\sprintf("/booking/tour/%d", $tour->getId()));
	}
	
	public function logout()
	{
		$session = $this->getSession();
		
		if (!$session->isLoggedIn()) {
			$this->forward('/');
		}
		
		$session->getObjectBag()->remove('user');
		$session->reset();
		
		$this->forward('/');
	}
}
