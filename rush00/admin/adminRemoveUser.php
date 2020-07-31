<?php
session_start();
if ($_SESSION['adusername'])
{
	if ($_POST["submit"] === "Remove a user")
	{
		if ($_POST["name"] == "" || $_POST["login"] == "" || $_POST["email"] == "")
		{
			echo "<h1><b style='color: red'>Your input haven't matched with database records</b></h1>";
			echo "<h3>You will be redirected to Admin home page after 5 seconds</h3>";
			header("Refresh: 5; url=adminHome.php");
			exit();
		}
		$id = $_POST["id"];
		$name = $_POST["name"];
		$login = $_POST["login"];
		$email = $_POST["email"];

		$con = mysqli_connect("localhost", "root", "123456", "rush00");
		if ( mysqli_connect_errno() ) 
		{
			exit('Failed to connect to MySQL: ' . mysqli_connect_error());
		}
		$query = "DELETE FROM `users` WHERE user_id='$id' AND name='$name' AND login='$login'";
		$results = mysqli_query($con, $query);
		if ($results)
		{
			echo "<b style='color: green'><h2>You just deleted '$login' from user</h2></b>";
			header("Refresh: 5; url=adminHome.php");
		}
		else
		{
			echo "<h1><b style='color: red'>Something went wrong. You failed to remove an user</b></h1>";
			echo "<h3>You will be redirected to Admin home page after 5 seconds</h3>";
			header("Refresh: 5; url=adminHome.php");
		}

	}
	?>
<html>
	<body>
		<fieldset style="width: 500px; text-align: center;">
		<h2>Remove a User</h2>
			<form method="POST" style="margin: 10px">
					ID: <input type="text" name="id" value="" placeholder="User ID"/><br/><br/>		
					Name: <input type="text" name="name" value="" placeholder="User Name"/><br/><br/>
					Login: <input type="text" name="login" value="" placeholder="User Login"/><br/><br/>
					Email: <input type="text" name="email" value="" placeholder="User Email"/><br/><br/>
					<input type="submit" name="submit" value="Remove a user" style="width: 150px;margin-left: 50px; margin-bottom: 10px; height: 30px; background-color: red">
			</form>
		</fieldset>
	</body>
</html>


<?php
}
