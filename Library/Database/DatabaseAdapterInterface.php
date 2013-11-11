<?php 

namespace Library\Database;

interface DatabaseAdapterInterface {

	public function connect();
	
	public function disconnect();
	
	public function execute($sql);

	public function select($table, array $fields, $where = '1');

	public function insert($table, array $fields);

	public function update($table, array $value, $where = '');

	public function delete($table, $where = '');
	
	public function getLastInsertId();
}

