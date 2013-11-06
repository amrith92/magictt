<?php

namespace Library\Session\Bag;

use Library\Session\SessionBagInterface;

abstract class AbstractBag implements SessionBagInterface
{
	protected $bag;
	
	public function __construct() {
		$this->attach();
	}
	
	public function rewind() {
		\reset($this->bag);
	}
	
	public function current() {
		return \current($this->bag);
	}
	
	public function key() {
		return \key($this->bag);
	}
	
	public function next() {
		\next($this->bag);
	}
	
	public function valid() {
		return \key($this->bag) !== null;
	}
	
	public function offsetSet($offset, $value) {
		if (\is_null($offset)) {
			$this->bag[] = $value;
		} else {
			$this->bag[$offset] = $value;
		}
	}
	
	public function offsetExists($offset) {
		return isset($this->bag[$offset]);
	}
	
	public function offsetUnset($offset) {
		unset($this->bag[$offset]);
	}
	
	public function offsetGet($offset) {
		return isset($this->bag[$offset]);
	}
	
	public function add($key, $item) {
		$this->offsetSet($key, $item);
	}
	
	public function get($item) {
		if (!isset($this->bag[$item])) {
			return null;
		}
		
		return $this->bag[$item];
	}
	
	public function remove($item) {
		if ($this->offsetExists($item)) {
			$this->offsetUnset($item);
		}
	}
	
	public function clear() {
		unset($this->bag);
	}
	
	public function has($item) {
		return $this->offsetExists($item);
	}
	
	// Attach storage at point
	abstract protected function attach();
}
