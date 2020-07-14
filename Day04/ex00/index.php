<?php
session_start();
if ($_GET["submit"] == "OK")
{
	$_SESSION["login"]= $_GET["login"];
	$_SESSION["passwd"] = $_GET["passwd"];
}
?>
<html><body>
<form action="." method="get">
Username: <input type="text" name="login" value="<?php if($_SESSION["login"]) {echo $_SESSION["login"];} ?>"/>
<br />
Password: <input type="password" name="passwd" value="<?php echo $_SESSION["passwd"] ?>" />
<input type="submit" value="OK" name="submit" />
</form>
</body></html>
