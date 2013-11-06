<?php

namespace Library\Encryption;

class Coder256 extends AbstractCoder {

	public function __construct() {
		parent::__construct();
	}

	public function encrypt($text) {
		$key_size = \strlen($this->key);
		
		$iv_size = \mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
		$iv = \mcrypt_create_iv($iv_size, MCRYPT_RAND);
		
		$ciphertext = \mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $this->key, $text, MCRYPT_MODE_CBC, $iv);
		
		$ciphertext = $iv . $ciphertext;
		
		return \base64_encode($ciphertext);
	}
	
	public function decrypt($riddle) {
		$ciphertext_dec = \base64_decode($riddle);
		
		$iv_size = \mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
		
		$iv_dec = \substr($ciphertext_dec, 0, $iv_size);
		
		$ciphertext_dec = \substr($ciphertext_dec, $iv_size);
		
		$decrypted = \mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $this->key, $ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec);
		
		return $decrypted;
	}
}

