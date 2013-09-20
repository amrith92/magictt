<?php

namespace Library\Database;

class MysqlAdapter implements DatabaseAdapterInterface {

	private static $hostname = "aesahaettr:3306";
	private static $username = "muthu";
	private static $password = "P@ssw0rd2013 !";
	private static $dbname = "magictt";
	private $conn = null;
	
	public function __construct() {
		$this->connect();
	}
	
	public function __destruct() {
		$this->disconnect();
	}
	
	public function connect() {
		if (!$this->conn) {
			$this->conn = \mysql_connect(self::$hostname, self::$username, self::$password);
		}
		
	  if (!$this->conn) {
	  	throw new \Exception("Connection Unsuccessful! :(");
	  }
	  
	  $select_status = \mysql_select_db(self::$dbname);
	  
	  if (!$select_status) {
	  	throw new \Exception("Database couldn't be selected!");
	  }
	}
	
	public function disconnect() {
		if ($this->conn) {
			\mysql_close($this->conn);
		}
	}
	
	public function execute($sql) {
		$result = \mysql_query($sql, $this->conn);
				
		if (!$result) {
			throw new \Exception("Invalid query! ");
		}
		
		$result_array = null;
		
		while($row = \mysql_fetch_assoc($result)) {
			$result_array[] = $row;
		}
		
		\mysql_free_result($result);
		
		return $result_array;
	}
}

