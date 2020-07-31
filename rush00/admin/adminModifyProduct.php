<?php
session_start();
if (isset($_SESSION['adusername']))
{
	if($_POST['change'] == "Change price")
	{
		if ($_POST["id"] == "" || $_POST["price"] == "")
		{
			echo "<h1><b style='color: red'>You should fill the all fields</b></h1>";
			header('Location: adminHome.php');
			exit();
		}
		$item_id = $_POST["id"];
		$price = $_POST["price"];

		$conn = mysqli_connect("localhost", "root", "123456", "rush00");
		if ( mysqli_connect_errno() ) 
		{
			exit('Failed to connect to MySQL: ' . mysqli_connect_error());
		}
		$query = "UPDATE items SET price='$price' WHERE item_id='$item_id'";
		$results = mysqli_query($conn, $query);
		if ($results)
		{
			echo "The of the product has been updated";
			echo "<h3>You will be redirected to admin home page in 5 seconds</h3>";
			header("Refresh: 5; url=adminHome.php");
		}
		else
		{
			echo "<h1><b style='color: red'>Something went wrong. You failed to update the price</b></h1>";
			echo "<h3>You will be redirected to admin home page in 5 seconds</h3>";
			header("Refresh: 5; url=adminHome.php");
		}
	}

	if ($_POST['delete'] == "Delete this product")
	{
		if ($_POST["id"] == "" || $_POST["model"] == "")
		{
			echo "<h1><b style='color: red'>You should fill the all fields</b></h1>";
			header('Location: adminHome.php');
			exit();
		}
		$item_id = $_POST["id"];
		$model = $_POST["model"];

		$conn = mysqli_connect("localhost", "root", "123456", "rush00");
		if ( mysqli_connect_errno() ) 
		{
			exit('Failed to connect to MySQL: ' . mysqli_connect_error());
		}
		$query = "DELETE FROM items WHERE `item_id`='$item_id' AND `model`='$model'";
		mysqli_query($conn, $query);
		if (mysqli_affected_rows($conn) > 0)
		{
			echo "<b style='color: green'><h2>You just deleted '$model' from products</h2></b>";
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
			<h1>Change the price for a product</h1>
			<form method="POST" action="" style="margin: 10px">
				ID: <input type="text" name="id" value="" placeholder="ID of the product" style="margin: 10px" /><br>
				Price: <input type="text" name="price" value="" placeholder="price" style="margin: 10px" /><br>
				<input type="submit" name="change" value="Change price" />
				<a href="adminHome.php"><h3>Return to Admin Home Page</h3></a>
			</form>
		</fieldset>
		<fieldset style="width: 500px; text-align: center;">
			<h1>Delete a product from products</h1>
			<form method="POST" action="" style="margin: 10px">
				ID: <input type="text" name="id" value="" placeholder="ID of the product" style="margin: 10px" /><br>
				Model: <input type="text" name="model" value="" placeholder="Model" style="margin: 10px" /><br>
				<input type="submit" name="delete" value="Delete this product" />
				<a href="adminHome.php"><h3>Return to Admin Home Page</h3></a>
			</form>
		</fieldset>
	</body>
</html>
<?php
}
else
{
	echo "Something went wrong to add your product as an admin";
	header("Refresh: 5; url=adminHome.php");
}