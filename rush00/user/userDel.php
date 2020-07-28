<?php
if (isset($_POST['delete']) AND $_POST['delete'] == "Delete")
{
	$serverName = "localhost";
	$userName = "root"; 
	$password = "123456"; 
	$db = "rush00";

	$con = mysqli_connect($serverName, $userName, $password, $db);
	if ( mysqli_connect_errno() ) {
		exit('Failed to connect to MySQL: ' . mysqli_connect_error());
	}

	if (!isset($_POST['login'], $_POST['passwd']))
	{
		exit('Please fill both the username and password fields!');
	}
	$login = mysqli_real_escape_string($con, $_POST['login']);
	$passwd = hash('sha256', mysqli_real_escape_string($con, $_POST['passwd']));
	$query = "SELECT * FROM users WHERE `login`='$login' AND `password`='$passwd'";
	$results = mysqli_query($con, $query);
	session_start();
	if (mysqli_num_rows($results) == 1)
	{
		$query = "DELETE FROM users WHERE `login`='$login' AND `password`='$passwd'";
		$results = mysqli_query($con, $query);
		if (mysqli_affected_rows($con) > 0) 
		{
			unset($_SESSION['user']);
			$_SESSION['user'] = NULL;
			header('location: index.php');
			die();
		}
		else 
		{
			echo "<b style='color: red'>Couldn't delete account. Please check username/password combination.</b>";
		}
	}
	else 
	{
		echo "<b style='color: red'>Couldn't delete account. Please check username/password combination.</b>";
	}
}

?>

<html>
	<body>
		<h2>Delete a user</h2>
		<br />
		<b style='color: red'>Warning: you are about to delete your account.</b><br />
		<b style='color: red'>All data will be lost. Action cannot be undone.</b>
	<fieldset style="width: 500px; text-align: center;">
		<form method="POST" style="margin: 10px">		
				Username: <input type="text" name="login" value="" /><br/><br/>
				Password: <input type="password" name="passwd" value="" /><br/><br/>
				<input type="submit" name="delete" value="Delete" style="width: 80px;margin-left: 185px; margin-bottom: 10px; height: 30px">
		</form>
	</fieldset>
	<body>
</html>