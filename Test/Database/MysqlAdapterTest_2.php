<?php 

require_once '../loader.php';

use Library\Database\MysqlAdapter;

try {
	$mysql = new MysqlAdapter();
	$sql = "SELECT * FROM users";
	echo '<pre>' . var_export($mysql->execute($sql), true) . '</pre>';
	
} catch (\Exception $e) {
	echo $e->getMessage();
}
