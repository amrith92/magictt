<?php

namespace Library\Model;

interface LanguageInterface
{
	public function setLanguage($language);
	
	public function getLanguage();
	
	public function setIsOfficial($isOfficial);
	
	public function getIsOfficial();
	
	public function setPercentage($percentage);
	
	public function getPercentage();
}
