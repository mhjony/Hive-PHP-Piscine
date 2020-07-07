#!/usr/bin/php
<?php
if($argc > 2)
{
	$str_key = trim($argv[1]);
	foreach ($argv as $value)
	{
		$arr = explode(":", $value);
		if ($arr[0] === $str_key)
		{
			$result = $arr[1];
		}
	}
}
if ($result)
	echo $result."\n";
?>