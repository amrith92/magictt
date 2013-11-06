<?php

namespace Library\Session;

use \SessionHandler;
use Library\Encryption\CoderInterface;

class EncryptedSessionHandler extends SessionHandler {

	private $coder;
	
	public function __construct(CoderInterface $coder) {
		$this->coder = $coder;
	}
	
	public function read($id) {
		$data = parent::read($id);
		
		return $this->coder->decrypt($data);
	}
	
	public function write($id, $data) {
		$data = $this->coder->encrypt($data);
		
		return parent::write($id, $data);
	}
}

