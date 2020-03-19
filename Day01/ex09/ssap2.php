#!/usr/bin/php
<?php

	function cmp($a, $b)
	{
		$line = "AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz0123456789!\"
				#$%&'()*+,-./:;<=>?@[\]^_`{|}~";
		$i = 0;
		while ($i < strlen($a) || $i < strlen($b))
		{
			$a_i = strpos($line, $a[$i]);
			$b_i = strpos($line, $b[$i]);
			if ($a_i > $b_i)
				return (1);
			else if ($a_i < $b_i)
				return (-1);
			else 
				$i++;
		}
	}
		
	$array = array();
	if ($argc > 1)
	{
		$i = 1;
		while ($i < $argc)
		{
			$tmp = preg_split("/ +/", trim($argv[$i]));
			$array = array_merge($array, $tmp);
			$i++;
		}
	}
	usort($array, "cmp");
	$i = 0;
	while ($array[$i])
	{
		print "{$array[$i]}\n";
		$i++;
	}
?>