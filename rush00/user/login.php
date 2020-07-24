<?php
if (isset($_POST['Submit']))
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
		$user = mysqli_fetch_array($results);
		$user = array(
			'login' => $user['login'],
			'name' => $user['name'],
			'email' => $user['email'],
			'user_id' => $user['user_id']
		);
		$_SESSION['user'] = $user;
		header('location: index.php?page=userHome');
		die();
	}
	else 
	{
		echo "<b style='color: red'>Wrong username/password combination</b>";
	}
}
?>

<html>
	<body>
		<h2>Login</h2>
	<fieldset style="width: 500px; text-align: center;">
		<form method="POST" style="margin: 10px">		
				Username: <input type="text" name="login" value="" /><br/><br/>
				Password: <input type="password" name="passwd" value="" /><br/><br/>
				<input type="submit" name="Submit" value="Submit" style="width: 80px;margin-left: 185px; margin-bottom: 10px; height: 30px">
		</form>
	</fieldset>
	<body>
</html>