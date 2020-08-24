<?php
class NightsWatch implements IFighter{
	public $result;

	public function recruit($value){
		if ($value instanceof IFighter){
			$result = $value->fight();
		}
	}
	public function fight(){
		echo($result);
	}
}
?>