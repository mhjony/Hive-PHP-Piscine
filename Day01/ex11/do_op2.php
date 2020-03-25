#!/usr/bin/php
<?php
	function ft_validate ($str)
	{
		$i = 0;
		$line = "0123456789*/+-% ";
		while ($str[$i])
		{
			if (strstr($line, $str[$i]))
				$i++;
			else
				return (0);
		}
		return (1);
	}

	function ft_calculator ($str)
	{
		preg_match_all ("!\d+!", $str, $value);
		if (strstr($str, "+"))
			print($result = $value[0][0] + $value[0][1]);
		else if (strstr($str, "*"))
			print($result = $value[0][0] * $value[0][1]);
		else if (strstr($str, "/"))
			print($result = $value[0][0] / $value[0][1]);
		else if (strstr($str, "-"))
			print($result = $value[0][0] - $value[0][1]);
		else if (strstr($str, "%"))
			print($result = $value[0][0] % $value[0][1]);
	}
	if ($argc != 2)
		echo "Incorrect Parameters";
	else
	{
		if (!ft_validate($argv[1]))
			echo "Syntax Error";
		else
			ft_calculator($argv[1]);
	}
	echo "\n";
?>