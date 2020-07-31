<?php
session_start();
if ($_SESSION['adusername'])
{
	$conn = mysqli_connect("localhost", "root", "123456", "rush00");
	$queryUsers = mysqli_query($conn, "SELECT * FROM users");
	$queryOrders = mysqli_query($conn, "SELECT * FROM orders, items WHERE orders.item_id=items.item_id");
	echo "<h1>List of All users</h1>";
	echo "<table border='1 solid red'>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Login</th>
			<th>Email</th>
			<th>Action</th>
		</tr>";
		while($row = mysqli_fetch_array($queryUsers))
		{
			echo "<tr>";
			echo "<td>" . $row['user_id'] . "</td>";
			echo "<td>" . $row['name'] . "</td>";
			echo "<td>" . $row['login'] . "</td>";
			echo "<td>" . $row['email'] . "</td>";
			echo "<td><form method='post'><button type='submit' name='makeAdmin' value='".$row['user_id']."'>Make Admin</button></form></td>";
			echo "</tr>";
		}
	echo "</table>";
		/* List of users end here*/

		if (isset($_POST['makeAdmin']) AND $_POST['makeAdmin'] != NULL AND $_POST['makeAdmin'] != "")
		{
			$uid = $_POST['makeAdmin'];
			$query = mysqli_query($conn, "SELECT * FROM users WHERE `user_id`='$uid'");
			$row = mysqli_fetch_array($query);
			$username = $row['login'];
			$password = $row['password'];
			$admin_added = $row['name'] . " (login: " . $username . ", id: " . $row['user_id'] . ") added as admin.";
			$err_msg = "Error adding " . $row['name'] . " (login: " . $username . ", id: " . $row['user_id'] . ") as admin.";
			$is_adm = $row['name'] . " (login: " . $username . ", id: " . $row['user_id'] . ") is already an admin.";

			$res = mysqli_query($conn, "SELECT * FROM admin WHERE `username`='$username' AND `password`='$password'");
			if (mysqli_num_rows($res) > 0) 
			{
				echo "<b style='color: red'>$is_adm</b>";
			}
			else
			{
				mysqli_query($conn, "INSERT INTO admin (`username`, `password`) VALUES ('$username', '$password')");
				if (mysqli_affected_rows($conn) > 0)
					echo "<div><p>$admin_added</p></div>";
				else
				{
					echo "<b style='color: red'>$err_msg</b>";
				}
			}
		}


		echo "<h1>List of Orders</h1>";
		echo "<table border='1 solid red'>
			<tr>
				<th>Order ID</th>
				<th>User ID</th>
				<th>Item Name</th>
				<th>Item Model</th>
				<th>Quantity</th>
				<th>Amount</th>
				<th>Image</th>
			</tr>";
			while($row = mysqli_fetch_array($queryOrders))
			{
				echo "<tr>";
				echo "<td>" . $row['order_id'] . "</td>";
				echo "<td>" . $row['user_id'] . "</td>";
				echo "<td>" . $row['name'] . "</td>";
				echo "<td>" . $row['model'] . "</td>";
				echo "<td>" . $row['quantity'] . "</td>";
				echo "<td>" . $row['amount'] . "</td>";
				echo "<td><img src='".$row['img']."' alt='".$row['img']."' width='60' height='60' /></td>";
				echo "</tr>";
			}
		echo "</table>";

	?>
	<html>
		<head>
			<link rel="stylesheet" href="">
		</head>
		<body>
				<a href="adminAddProduct.php" style="margin: 20px"><h3>Add a product</h3></a>
				<a href="adminModifyProduct.php" style="margin: 20px"><h3>Modify a product</h3></a>
				<a href="adminRemoveUser.php" style="margin: 20px"><h3>Remove a user</h3></a>
			<form action="adminLogout.php" method="POST">
				<input type="submit" name="logout" value="Logout" style="width: 80px; height: 30px"/>
			</form>
		</body>
	</html>
	<?php
}
else
{
	header('Location: ../index.php');
}
?>
