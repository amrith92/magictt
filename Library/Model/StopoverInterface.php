<?php

namespace Library\Model;

use Library\Model\PlaceInterface;

interface StopoverInterface extends Identifiable{
	
	public function getPlace();

	public function setPlace(PlaceInterface $place);

	public function getDuration();

	public function setDuration($duration);
}
