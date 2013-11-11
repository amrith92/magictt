<?php

namespace Library\Controller;

use Library\Model\Collection\EntityCollection;

class BookingController extends AbstractController
{
	public function __construct() {
		parent::__construct();
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
				
				$now = new \DateTime();
				$diff = $now->diff($data[$i]['dateOfBirth']);
				
				if ($diff->y < 6) {
					$discount = $tour->getPrice() * 0.2;
				} else if ($diff->y > 60) {
					$discount = $tour->getPrice() * 0.1;
				} else {
					$discount = 0;
				}
				
				$data[$i]['payable'] = $tour->getPrice() - $discount;
			}
			
			for ($i = 0, $term = \count($_POST['ticket_gender']); $i < $term; ++$i) {
				$data[$i]['gender'] = \filter_var($_POST['ticket_gender'][$i], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			}
			
			foreach ($data as $row) {
				$ticket = $this->getEntityManager()->createNew('Ticket', $row);
				$tickets[] = $ticket;
			}
			
			$booking->setTickets(new EntityCollection($tickets));
			
			$session->getObjectBag()->add('booking', $booking);
			
			$this->renderView('booking/confirm.php', \compact('booking'));
		} catch (\Exception $e) {
			$this->respond(503, $e->getMessage());
		}	
	}
	
	public function confirm() {
		$session = $this->getSession();
		$booking = $session->getObjectBag()->get('booking');
		$booking->setStatus('Confirmed');
		
		//$this->getEntityManager()->getRepository('Booking')->save($booking);
		
		$user = $booking->getUser();
		$tour = $booking->getTour();
		
		$email = $this->getEmail();
		$email->addRecipient($user->getFullName(), $user->getEmail());
		$email->setFrom("MagicTT", "info@magictt.com");
		$email->fillSubject("Booking Confirmation");
		
		$message = "<!DOCTYPE html><html lang='en-GB'><body>";
		$message .= "<p>Hi <b>".$user->getFullName()."</b>,</p>";
		$message .= "<p>Congratulations you have successfully booked for the tour. Below are the details of the tour: </p><ul>";
		$message .= "<li><strong>Booking id:</strong> MTT0000". $booking->getId() . "</li>";
		$message .= "<li><strong>Tour Name:</strong> ". $tour->getName() . "</li>";
		$message .= "<li><strong>Journey Date:</strong> ". $booking->getJourneyDate()->format('F d, Y') . "</li>";
		$message .= "</ul>";
		$message .= '<table cellpadding="4" border="1">';
		$message .= '<thead><tr><th>Name</th><th>Date Of Birth</th><th>Gender</th><th>Amount (₹)</th></tr></thead><tbody>';
		
		$tickets = $booking->getTickets();
		for ($i = 0, $term = \count($tickets); $i < $term; ++$i) {
			$message .= '<tr>';
			$message .= "<td>{$tickets[$i]->getName()}</td><td>{$tickets[$i]->getDateOfBirth()->format('F dS, Y')}</td><td>{$tickets[$i]->getGender()}</td><td>{$tickets[$i]->getPayable()}</td>";
			$message .= '</tr>';
		}
		
		$message .= '</tbody></table>';
		$message .= "</body></html>";
		
		$email->fillMessage($message);
		$email->send();
		
		$this->renderView("booking/thankyou.php", \compact('booking'));
	}
	
	public function cancel() {
		$session = $this->getSession();
		
		if (!$session->getObjectBag()->has('booking')) {
			$this->respond(400, "You're not supposed to be here.");
		}
		
		$session->getObjectBag()->remove('booking');
		$this->forward('/');
	}
}
