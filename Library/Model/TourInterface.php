<?php

namespace Library\Model;

use Library\Mapper\EntityCollectionInterface;

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

	public function setStopovers(EntityCollectionInterface $stopovers);

	public function addStopover(StopoverInterface $theStopover);

	public function removeStopover(StopoverInterface $theStopover);
	
	public function setCategory($category);
	
	public function getCategory();
	
	public function setViews($views);
	
	public function getViews();

}
