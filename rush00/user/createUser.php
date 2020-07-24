<?php
session_start();
if (isset($_POST['submit']))
{
	if ($_POST['submit'] === "Sign up")
	{
		$con = mysqli_connect("localhost", "root", "123456", "rush00");
		if (!$con)
		{
			echo "Failed to connect with database! This is from createUser.php";
		}

		if (isset($_POST['name']) AND $_POST['name'] != NULL AND $_POST['name'] != ""
		AND isset($_POST['email']) AND $_POST['email'] != NULL AND $_POST['email'] != ""
		AND isset($_POST['login']) AND $_POST['login'] != NULL AND $_POST['login'] != ""
		AND isset($_POST['passwd']) AND $_POST['passwd'] != NULL AND $_POST['passwd'] != "")
		{
			$name = mysqli_real_escape_string($con, $_POST['name']);
			$email = mysqli_real_escape_string($con, $_POST['email']);
			$login = mysqli_real_escape_string($con, $_POST['login']);
			$passwd = hash('sha256', mysqli_real_escape_string($con, $_POST['passwd']));

			$res = mysqli_query($con, "SELECT * FROM users");
			$count = 0;
			while ($row = mysqli_fetch_array($res))
			{
				if ($row['login'] == $login)
				{
					$count = 1;
					echo "<b style='color: red'>This username already exists.</b>";
				}
			}
			if ($count == 0)
			{
				$query = "INSERT INTO users (`name`, `login`, `email`, `password`) VALUES ('$name', '$login','$email', '$passwd')";
				mysqli_query($con, $query);
				$query = "SELECT * FROM users WHERE `login`='$login' AND `password`='$passwd'";
				$results = mysqli_query($con, $query);
				$user = mysqli_fetch_array($results);
				$user = array(
					'login' => $user['login'],
					'name' => $user['name'],
					'email' => $user['email'],
					'user_id' => $user['user_id']
				);
				$_SESSION['user'] = $user;
				echo "User creation successful";
				header("location: index.php?page=userHome");
			}
		}
		else
		{
			echo "<b style='color: red'>Invalid name, username, email and/or password. Cannot be empty.</b>";
		}
	}
}

?>

<html>
<body>
	<fieldset style="width: 500px; text-align: center;">
		<form method="POST" style="margin: 10px">		
			Name: <input type="text" name="name" value="" placeholder="Full name" /><br>
			Email: <input type="text" name="email" value="" placeholder="john@example.com" /><br>
			Username: <input type="text" name="login" value="" placeholder="Login" /><br>
			Password: <input type="password" name="passwd" value="" placholder="Password" /><br>
				<input type="submit" name="submit" value="Sign up" style="width: 80px;margin-left: 185px; margin-bottom: 10px; height: 30px">
		</form>
	</fieldset>
</body>
</html>