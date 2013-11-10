<?php

namespace Library\Controller;

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
	
}
