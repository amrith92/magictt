<?php

namespace Library\Model;

class Language implements LanguageInterface
{
	protected $language;
	protected $isOfficial;
	protected $percentage;
	
	public function __construct(array $params = []) {
		foreach ($params as $k => $v) {
			$fn = 'set' . \ucfirst($k);
			
			if (\method_exists($this, $fn)) {
				$this->$fn($v);
			}
		}
	}
	
	public function setLanguage($language) {
		if (\strlen($language) < 1) {
			throw new \InvalidArgumentException("Language must be a string!");
		}
		
		$this->language = $language;
		
		return $this;
	}
	
	public function getLanguage() {
		return $this->language;
	}
	
	public function setIsOfficial($isOfficial) {
		if (!\is_bool($isOfficial)) {
			throw new \InvalidArgumentException("Must be a boolean value!");
		}
		
		$this->isOfficial = ($isOfficial) ? 'T' : 'F';
		
		return $this;
	}
	
	public function getIsOfficial() {
		return $this->isOfficial;
	}
	
	public function setPercentage($percentage) {
		$this->percentage = $percentage;
		
		return $this;
	}
	
	public function getPercentage() {
		return $this->percentage;
	}
}
