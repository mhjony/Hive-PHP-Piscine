<?php
session_start();

if (isset($_SESSION['user']) AND $_SESSION['user']['name'] != "" AND $_SESSION['user']['name'] != NULL)
{
	echo "<table border='1 solid red'>
	<tr>
	<th>Name</th>
	<th>Username</th>
	<th>Email</th>
	<th colspan='2'>Action</th>
	</tr>";

    echo "<tr>";
    echo "<td>" . $_SESSION['user']['name'] . "</td>";
    echo "<td>" . $_SESSION['user']['login'] . "</td>";
    echo "<td>" . $_SESSION['user']['email'] . "</td>";
	echo "<td><form method='post'><input type='submit' name='delete' value='Delete Account'></form></td>";
	echo "<td><form method='post'><input type='submit' name='logout' value='Log Out'></form></td>";
	echo "</tr>";

	echo "</table><br />";

	if (isset($_POST['delete']) AND $_POST['delete'] == "Delete Account")
	{
		header("location: index.php?page=userDel");
	}

	if (isset($_POST['logout']) AND $_POST['logout'] == "Log Out")
	{
		header("location: index.php?page=userLogout");
	}

}
?>