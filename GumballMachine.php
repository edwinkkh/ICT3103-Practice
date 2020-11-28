<?php

class GumballMachine {

	private $gumballs;
	
	public function getGumballs() {
		return $this->gumballs;
	}
	
	public function setGumballs($amount) {
		$name ="edwin";
		$name = 123;
		echo $name;
		
		$this->gumballs = $amount;
	}
	
	public function turnWheel() {
		$this->setGumballs($this->getGumballs()-1);
	}
}
