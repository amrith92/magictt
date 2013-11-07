<?php

namespace Library\Database;

class MysqlAdapter implements DatabaseAdapterInterface {

	private $parameters = [];
	private $conn = null;
	
	public function __construct(array $parameters) {
		$this->parameters = $parameters;

		$this->connect();
	}
	
	public function __destruct() {
		$this->disconnect();
	}
	
	public function connect() {
		if (!$this->conn) {
			$this->conn = new \mysqli($this->parameters['hostname'], $this->parameters['username'], $this->parameters['password'], $this->parameters['dbname']);
		}
		
	  if ($this->conn->connect_errno) {
	  	throw new \Exception("Connection Unsuccessful: " . $this->conn->connect_error);
	  }
	}
	
	public function disconnect() {
		if ($this->conn) {
			$this->conn->close();
		}
	}
	
	public function execute($sql) {
		$result = $this->conn->query($sql);
				
		if (!$result) {
			throw new \RuntimeException(\sprintf("Query malformed. [%s]", $sql));
		}
		
		$result_array = null;
		
		while($row = $result->fetch_assoc()) {
			$result_array[] = $row;
		}
		
		$result->free();
		
		return $result_array;
	}

	public function select($table, array $fields = [], $where = '1') {
		if (empty($fields)) {
			$fields = '*';
		} else {
			$fields = \implode(', ', $fields);
		}
		
		$sql = "SELECT {$fields} FROM `{$table}` WHERE {$where}";
		
		return $this->execute($sql);
	}

	public function insert($table, array $fields) {
		$sql = "INSERT INTO `" . $table . "`(" . \implode(', ',\array_keys($fields)) . " ) VALUES (" . \implode(', ', \array_values($fields)) . " )";
		
		return $this->execute($sql);
	}

	public function update($table, array $value, $where = '1') {
		$values = '';
		$comma = false;
			
		foreach($value as $key => $v) {
			if($comma) {
				$values .= ',';
			}
			$values .= "`$key` = $v";
			$comma = true;	
		}
		
		$sql = "UPDATE `" . $table . "` SET " . $values . " WHERE " . $where; 
		
		return $this->execute($sql);
	}

	public function delete($table, $where = '1') {
		$sql = "DELETE FROM `" . $table . "` WHERE " . $where;
		
		return  $this->execute($sql);
	}
}

