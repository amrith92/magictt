<?php

namespace Library\Session;

use \SessionHandlerInterface;
use Library\Session\Bag\FlashBag;
use Library\Session\Bag\DirtyFormBag;

class Session implements SessionInterface {
	protected $flashBag;
	
	protected $dirtyFormBag;

	public function __construct(SessionHandlerInterface $handler, $mode = 'files') {
		\ini_set('session.save_handler', $mode);
		
		\session_set_save_handler($handler, true);
		
		$this->flashBag = new FlashBag();
		$this->dirtyFormBag = new DirtyFormBag();
	}
	
	public function start() {
		if (\session_status() == PHP_SESSION_NONE) {
			\session_start();
		}
	}
	
	public function destroy() {
		if (\session_status() == PHP_SESSION_ACTIVE) {
			\session_destroy();
		}
	}
	
	public function clear() {
		\session_unset();
	}
	
	public function add($key, $value) {
		$this->offsetSet($key, $value);
	}
	
	public function remove($key) {
		$this->offsetUnset($key);
	}
	
	public function get($key) {
		if ($this->offsetExists($key)) {
			return $_SESSION[$key];
		}
		
		return null;
	}
	
	public function getFlashBag() {
		return $this->flashBag;
	}
	
	public function getDirtyFormBag() {
		return $this->dirtyFormBag;
	}
	
	public function offsetExists($offset) {
		return isset($_SESSION[$offset]);
	}
	
	public function offsetGet($offset) {
		return isset($_SESSION[$offset]);
	}
	
	public function offsetUnset($offset) {
		unset($_SESSION[$offset]);
	}
	
	public function offsetSet($offset, $value) {
		if (\is_null($offset)) {
			$_SESSION[] = $value;
		} else {
			$_SESSION[$offset] = $value;
		}
	}
	
	public function rewind() {
		\reset($_SESSION);
	}
	
	public function current() {
		return \current($_SESSION);
	}
	
	public function key() {
		return \key($_SESSION);
	}
	
	public function next() {
		\next($_SESSION);
	}
	
	public function valid() {
		return \key($_SESSION) !== null;
	}
	
	public function isLoggedIn() {
		return isset($_SESSION['logged_in']);
	}
}

