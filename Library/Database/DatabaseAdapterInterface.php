<?php 

namespace Library\Database;

interface DatabaseAdapterInterface {

	public function connect();
	
	public function disconnect();
	
	public function execute($sql);
}

