<?php
class Targaryen{
	public function resistsFire()
	{
		return false;
	}

	public function getBurned(){
		if (!$this->resistsFire()){
			return("burns alive");
		}
		else{
			return("emerges naked but unharmed");
		}
	}
}
?>