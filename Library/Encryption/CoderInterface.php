<?php

namespace Library\Encryption;

interface CoderInterface {

	public function encrypt($text);
	
	public function decrypt($riddle);
}

