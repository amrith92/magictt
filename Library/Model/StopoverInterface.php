<?php

namespace Library\Model;

interface StopoverInterface extends Identifiable{
	
	public function getPlace();

	public function setPlace(PlaceInterface $place);

	public function getDuration();

	public function setDuration($duration);
}
