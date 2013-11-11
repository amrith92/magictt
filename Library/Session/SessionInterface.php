<?php

namespace Library\Session;

interface SessionInterface extends \ArrayAccess, \Iterator
{
	public function start();
	
	public function destroy();
	
	public function clear();
	
	public function reset();
	
	public function getFlashBag();
	
	public function getDirtyFormBag();
	
	public function getObjectBag();
	
	public function add($key, $value);
	
	public function remove($key);
	
	public function get($key);
	
	public function isLoggedIn();
	
	public function getUserId();
	
	public function setUserId($id);
}
