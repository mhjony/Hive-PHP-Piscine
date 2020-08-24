<?php
class Jaime extends Lannister{
	public function sleepWith($target)
	{
		if (get_class($target) == 'Tyrion')
			echo "Not even if I'm drunk !\n";
		elseif (get_class($target) == 'Sansa')
			echo "Let's do this.\n";
		elseif(get_class($target) == 'Cersei')
			echo "With pleasure, but only in a tower in Winterfell, then.\n";
	}
}
?>