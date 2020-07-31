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

	if (!isset($_POST['adusername'], $_POST['adpasswd']))
	{
		exit('Please fill both the username and password fields!');
	}
	$adusername = mysqli_real_escape_string($con, $_POST['adusername']);
	$adpasswd = hash('sha256', mysqli_real_escape_string($con, $_POST['adpasswd']));

	$query = "SELECT * FROM admin WHERE username='$adusername' AND password='$adpasswd'";
	$results = mysqli_query($con, $query);
	session_start();
	if (mysqli_num_rows($results) == 1) 
	{
		unset($_SESSION['user']);
		$_SESSION['user'] = NULL;
		unset($_SESSION['cart']);
		$_SESSION['cart'] = NULL;
		$_SESSION['adusername'] = $adusername;
		header('location: admin/adminHome.php');
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
		<h2>Admin Login</h2>
	<fieldset style="width: 500px; text-align: center;">
		<form method="POST" style="margin: 10px">		
				Admin Username: <input type="text" name="adusername" value="" /><br/><br/>
				Admin Password: <input type="password" name="adpasswd" value="" /><br/><br/>
				<input type="submit" name="Submit" value="Submit" style="width: 80px;margin-left: 185px; margin-bottom: 10px; height: 30px">
		</form>
	</fieldset>
	<body>
</html>