<?php
session_start();
if ($_SESSION['adusername'])
{
	if ($_POST["add"] === "ADD")
	{
		if ($_POST["name"] == "" || $_POST["type"] == "" || $_POST["model"] == "" || $_POST["description"] == "" || $_POST["price"] == "" || $_POST["img"] == "")
		{
			echo "You need to fill all of the fileds";
			header('Location: adminHome.php');
			exit();
		}
		$name = $_POST["name"];
		$type = $_POST["type"];
		$model = $_POST["model"];
		$description = $_POST["description"];
		$price = $_POST["price"];
		$img = $_POST["img"];
		
		$con = mysqli_connect("localhost", "root", "123456", "rush00");
		if ( mysqli_connect_errno() ) 
		{
			exit('Failed to connect to MySQL: ' . mysqli_connect_error());
		}
		$query = "INSERT INTO items (`name`, `type`, `model`, `description`, `price`, `img`) VALUES
		('$name', '$type', '$model', '$description', '$price', '$img')";
		$results = mysqli_query($con, $query);
		if ($results)
		{
			echo "Product has been added successfully";
			header("Refresh: 5; url=adminHome.php");
		}
		else
		{
			echo "Something went wrong to add your product";
			header("Refresh: 5; url=adminHome.php");
		}
	}
	?>
<form method="POST" action="" style="margin: 10px">
    Name: <input type="text" name="name" value="" placeholder="e.g. Nokia" style="margin: 10px" /><br>
    Type:  <input type="text" name="type" value="" placeholder="e.g. Smartphone" style="margin: 10px" /><br>
    Model: <input type="text" name="model" value="" placeholder="e.g Nokia 9" style="margin: 10px" /><br>
    Description: <input type="text" name="description" value="" placeholder="Description" style="margin: 10px" /><br>
    Price: <input type="text" name="price" value="" placeholder="price" style="margin: 10px" /><br>
    Image: <input type="text" name="img" value="" placeholder="Image link" style="margin: 10px" /><br>
    <input type="submit" name="add" value="ADD" />
	<a href="adminHome.php"><h3>Return to Admin Home</h3></a>
</form>
<?php
}
else
{
	echo "Something went wrong to add your product as an admin";
	header("Refresh: 5; url=adminHome.php");
}


