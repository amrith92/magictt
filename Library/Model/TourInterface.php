<?php

namespace Library\Model;

interface TourInterface extends Identifiable{
	
	public function getName();

	public function setName($name);

	public function getDescription();

	public function setDescription($desc);

	public function getPicture();

	public function setPicture($pictureUrl);

	public function getPrice();

	public function setPrice($price);

	public function getStopovers();

	public function setStopovers(array $stopovers);

	public function addStopover(Stopover $theStopover);

	public function removeStopover(Stopover $theStopover);

}
