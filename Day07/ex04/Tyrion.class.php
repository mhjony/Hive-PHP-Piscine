<?php
class Tyrion extends Lannister{
	public function sleepWith($target)
	{
		if (get_class($target) == 'Jaime')
			echo "Not even if I'm drunk !\n";
		elseif (get_class($target) == 'Sansa')
			echo "Let's do this.\n";
		elseif(get_class($target) == 'Cersei')
			echo "Not even if I'm drunk !\n";
	}
}
?>