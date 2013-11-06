<?php

namespace Library\Session;

interface SessionBagInterface extends \ArrayAccess, \Iterator
{
	public function add($key, $item);
	
	public function remove($item);
	
	public function get($item);
	
	public function clear();
	
	public function has($item);
}
