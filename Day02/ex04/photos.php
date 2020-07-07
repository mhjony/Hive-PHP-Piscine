#!/usr/bin/php
<?php
if ($argc != 2)
	exit ("Exit, wrong nbr of args!\n");
$url = preg_replace('/\/$/', '', $argv[1]); //removing the last / from the url
if (!$page = file_get_contents($url))
	exit("Page doesn't exist!\n");
preg_match_all("/<img .*?>/", $page, $tab); //searching for img tags and store it tab variable
$stock = $tab[0];
preg_match("/[^\/]*\$/", $url, $folder_tab); //choosing appropriate folder name
$folder = $folder_tab[0] . "/";
print_r($folder);

if (file_exists($folder))
	exit ("Folder " . $folder ." exists already!\n");
mkdir($folder);

foreach ($stock as $img) {
	preg_match("/src=[\"].*?[\"]/", $img, $src_tab); //src="https://www.42.fr/wp-content/themes/42/images/42_logo_black.svg"
	$src = substr($src_tab[0], 5, -1); //https://www.42.fr/wp-content/themes/42/images/42_logo_black.svg
	preg_match("/[^\/]*\$/", $src, $name_tab);
	//print_r($name_tab);
	$name = $name_tab[0];
	if (preg_match("/http?.:\/\//", $src))
		copy($src, $folder . $name);
	else
		copy($argv[1] . "/" . trim($src, "/"), $folder . $name);
}

?>