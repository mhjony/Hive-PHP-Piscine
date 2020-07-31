<?php
session_start();
$_SESSION["adusername"] = "";
if (!($_SESSION["adusername"]))
{
	header('Location: ../index.php');
}
?>