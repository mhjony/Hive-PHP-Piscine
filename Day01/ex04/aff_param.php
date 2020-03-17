#!/usr/bin/php
<?php
	$i = 1;
	foreach ($argv as $value)
	{
		if ($i > 1)
			echo $value . "\n";
		$i++;
	}
?>
