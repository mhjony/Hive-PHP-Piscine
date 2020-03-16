#!/usr/bin/php
<?php
	while (true)
	{
		echo "Enter a number: ";
		$number = fgets(STDIN);
		if (feof(STDIN))
			break;
		$number = trim($number);
		if (!(is_numeric($number)))
			echo "'$number' is not a number\n";
		else
		{
			if($number % 2 == 1)
				echo "The number $number is odd\n";
			else
				echo "The number $number is even\n";
		}
	}
	echo "\n";
?>
