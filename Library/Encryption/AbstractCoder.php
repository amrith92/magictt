<?php

namespace Library\Encryption;

abstract class AbstractCoder implements CoderInterface {

	protected $passphrase;
	
	protected $salt;
	
	protected $key;
	
	protected function __construct() {
		$this->passphrase = 'SHITzu @3%%4 n00b';
		
		$this->salt = 'nw.I?,6S8W~O?T$&c{w*.SHhf2{Hh?N|.F<YP{G !|](^wb,2,t[1AtOuPw[IdXcAHh.R1`re-YIC6`w5quW$NAujBmB25;wcn9<~&Deb6z[vseB7ov<&:xbd</:&)J/';
		
		$this->key = \hash('sha256', $this->passphrase . $this->salt, TRUE);
	}
	
	abstract public function encrypt($text);
	
	abstract public function decrypt($riddle);
}

