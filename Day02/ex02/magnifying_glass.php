#!/usr/bin/php
<?php
function replace($matches)
{
    $str = $matches[1].strtoupper($matches[2]).$matches[3];
    return ($str);
}
if ($argc == 2 && file_exists($argv[1]))
{
    $content = file_get_contents($argv[1]);
    $content = preg_replace_callback("/(<a )(.*?)(>)(.*)(<\/a>)/is", function ($matches)
    {
        $matches[0] = preg_replace_callback("/( title=\")(.*?)(\")/is", "replace", $matches[0]);
        $matches[0] = preg_replace_callback("/(>)(.*?)(<)/is", "replace", $matches[0]);
        return ($matches[0]);
    }, $content);
    echo $content;
}
?>