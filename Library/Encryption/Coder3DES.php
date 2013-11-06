<?php

namespace Library\Encryption;

class Coder3DES extends AbstractCoder
{
	public function __construct() {
		parent::__construct();
		
		$this->key = \substr($this->key, 0, 24);
	}

	public function encrypt($text) {
		return \mcrypt_encrypt(MCRYPT_3DES, $this->key, $text, MCRYPT_MODE_ECB);
	}
	
	public function decrypt($riddle) {
		return \mcrypt_decrypt(MCRYPT_3DES, $this->key, $riddle, MCRYPT_MODE_ECB);
	}
}
