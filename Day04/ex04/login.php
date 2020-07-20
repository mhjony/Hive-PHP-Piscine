<?php
	include('auth.php');

	session_start();
	if ($_POST["login"] && $_POST["passwd"] && auth($_POST["login"], $_POST["passwd"]))
	{
		$_SESSION["loggued_on_user"] = $_POST["login"];
	}
	else
	{
		$_SESSION["loggued_on_user"] = "";
		header('Location: index.html');
	}
?>

<html>
	<body>
		<form>
			<iframe name="chat" src="chat.php" width="100%" height="550px"></iframe>
			<iframe name="speak" src="speak.php" width="100%" height="50px"></iframe>
			<input type="submit" name="logout" formaction="logout.php" value="Log out"/>
		</form>
	</body>
</html>
