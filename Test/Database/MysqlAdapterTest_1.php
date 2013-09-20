<?php

require_once '../loader.php';

use Library\Database\MysqlAdapter;

try {
	$mysqldb = new MysqlAdapter();
	
	echo "<h1>Successfully connected.</h1>";
} catch(\Exception $e) {
	echo $e->getMessage();
}
