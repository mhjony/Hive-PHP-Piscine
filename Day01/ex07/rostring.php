#!/usr/bin/php
<?php
	if ($argc == 1)
		exit();
	$arr = array_filter(explode(" ", $argv[1]));
	$first_element = array_shift($arr);
	array_push($arr, $first_element);
	$str = implode(" ", $arr);
	if (!empty($str))
		echo "$str\n";
?>