<?php

namespace Library\Controller;

class TourController extends AbstractController {

	public function __construct() {
		parent::__construct();
	}
	
	public function index()
	{
		try {
			$em = $this->getEntityManager();
			$tours = $em->getRepository('Tour')->findAll();
			
			echo '<table border="2" cellpadding="4"><thead><tr><th>ID</th><th>Name</th><th>Description</th></tr></thead><tbody>';
			foreach ($tours as $tour) {
				echo "<tr><td>{$tour->getId()}</td><td>{$tour->getName()}</td><td>{$tour->getDescription()}";
				
				echo "<div><ul>";
				foreach ($tour->getStopovers() as $stopover) {
					echo "<li>{$stopover->getPlace()->getName()}, {$stopover->getPlace()->getCountry()->getName()}</li>";
				}
				echo "</ul></div>";
				
				echo "</td></tr>";
			}
			
			echo '</tbody></table>';
		} catch (\Exception $e) {
			echo '<strong>THIS</strong> went wrong: <code>' . $e->getMessage() . '</code>';
			echo '<pre>' . $e->getTraceAsString() . '</pre>';
		}
	}
}
