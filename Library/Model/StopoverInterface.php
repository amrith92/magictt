<?php

namespace Library\Model;

interface StopoverInterface extends Identifiable{
	
	public function getPlace();

	public function setPlace(Place $place);

	public function getDuration();

	public function setDuration($duration);

	public function getTours();

	public function setTours(array $tours);
}
