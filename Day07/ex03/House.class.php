<?php
abstract class House{
	abstract function getHouseName();
	abstract function getHouseSeat();
	abstract function getHouseMotto();
	function introduce(){
		echo "House {$this->getHouseName()} of {$this->getHouseSeat()} : \"{$this->getHouseMotto()}\"\n";
	}
}
?>