<?php 

require_once '../../Library/Model/UserInterface.php';
require_once '../../Library/Model/User.php';

use Library\Model\User;

try {
	$testuser = new User([
		'id' => 5,
		'email' => "muthuqumar@live.in",
		'password' => \hash('sha256', 'P@ssw0rd2013 !'),
		'firstname' => "Muthu Qumar",
		'lastname' => "S",
		'dob' => \DateTime::createFromFormat('Y-m-d', '1992-10-29'),
		'gender' => "Male"
	]);
	
	echo '<pre>' . var_export($testuser, true) . '</pre>';
} catch (\Exception $e) {
	echo $e->getMessage();
}

