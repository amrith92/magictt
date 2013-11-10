<?php

namespace Library\Controller;

class BookingController extends AbstractController
{
	public function __construct() {
		parent::__construct();
		$this->getSession()->setUserId('1'); // TESTING
	}
	
	public function tour($id)
	{
		$tour = $this->getEntityManager()->getRepository('Tour')->find($id);
		
		$this->renderView('booking/index.php', \compact('tour'));
	}
	
	public function process()
	{
		if (!isset($_POST['tourId'])) {
			$this->respond(400, "You're not supposed to be here!");
		}
		
		$session = $this->getSession();
		
		try {
			$booking = $this->getEntityManager()->createNew('Booking');
			$tour = $this->getEntityManager()->getRepository('Tour')->find(\filter_var($_POST['tourId'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
			$user = $this->getEntityManager()->getRepository('User')->find($session->getUserId());

			$booking->setUser($user);
			$booking->setTour($tour);

			$booking->setJourneyDate(\DateTime::createFromFormat('d-m-Y', \filter_var($_POST['journeyDate'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
			
			foreach ($_POST['ticket_name'] as $name) {
				$data[] = ['name' => \filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS)];	
			}
			
			for ($i = 0, $term = \count($_POST['ticket_dob']); $i < $term; ++$i) {
				$data[$i]['dateOfBirth'] = \DateTime::createFromFormat('d-m-Y', \filter_var($_POST['ticket_dob'][$i], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
			}
			
			for ($i = 0, $term = \count($_POST['ticket_gender']); $i < $term; ++$i) {
				$data[$i]['gender'] = \filter_var($_POST['ticket_gender'][$i], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			}
			
			foreach ($data as $row) {
				$ticket = $this->getEntityManager()->createNew('Ticket', $row);
				$booking->addTicket($ticket);
			}
			
			$session->getObjectBag()->add('booking', $booking);
			
			echo 'Yay!';
		} catch (\Exception $e) {
			echo $e->getMessage();
		}
	}
}
