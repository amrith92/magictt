<?php

namespace Library\Controller;

class TourController extends AbstractController {

	public function __construct() {
		parent::__construct();
	}
	
	public function index()
	{
		try {
			$db = $this->getDatabase();
			
			echo '<pre>' . \var_export($db->select('tour', ['id']), true) . '</pre>';
		} catch (\Exception $e) {
			echo '<strong>THIS</strong> went wrong: <code>' . $e->getMessage() . '</code>';
			echo '<pre>' . $e->getTraceAsString() . '</pre>';
		}
	}
}
