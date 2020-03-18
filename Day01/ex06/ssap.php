#!/usr/bin/php
<?php
	$i = 1;
	$arr = array();
	foreach ($argv as $value)
	{
		if ($i++ > 1)
		{
			$str = preg_split("/ +/", trim($value));
			if ($str[0] != "")
			{
				$arr = array_merge($arr, $str);
			}
		}
	}
	sort($arr);
	foreach($arr as $elements)
	{
		echo "$elements"."\n";
	}
?>