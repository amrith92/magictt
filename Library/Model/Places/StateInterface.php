<?php

namespace Library\Model\Places;

interface StateInterface extends Identifiable{

	public function setState($state);

	public function getState();
} 
