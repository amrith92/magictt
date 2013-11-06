<?php

namespace Library\Session;

interface SessionInterface extends \ArrayAccess, \Iterator
{
	public function start();
	
	public function destroy();
	
	public function clear();
	
	public function getFlashBag();
	
	public function getDirtyFormBag();
	
	public function add($key, $value);
	
	public function remove($key);
	
	public function get($key);
}
