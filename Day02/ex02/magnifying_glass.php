#!/usr/bin/php
<?php

function get_string_between($string, $start, $end){
	$string = ' ' . $string;
    $ini = strpos($string, $start);
	if ($ini == 0) 
		return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

function make_it_upper($str)
{
	$tmp1 = get_string_between($str, "<a", "/a>");
	$tmp1 = get_string_between($tmp1, ">", "<");
	$tmp2 = get_string_between($str, "title=\"", "\">");
	$str = str_ireplace($tmp2, strtoupper($tmp2), $str);
	$str = str_ireplace($tmp1, strtoupper($tmp1), $str);
	return $str;
}

$fd = fopen($argv[1], "r");

while(! feof($fd))  
{
	$line = fgets($fd);
	if (get_string_between($line, "<a", "</a>"))
		$line = make_it_upper($line);
	print $line;
}

fclose($fd);
?>