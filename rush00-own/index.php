<?php
session_start();

if (!isset($_GET['page']) || $_GET['page'] == "home")
{
    $page = "views/home.html";
}
if ($_GET['page'] == "contact")
{
    $page = "views/contact.html";
}

if ($_GET['page'] == "all")
{
    $page = "views/items.php";
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Dropdown menu</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<div id="header">
			<ul>
                <li><a href="index.php?page=home">Home</a></li>
                <li><a href="#">Category</a>
					<ul>
						<li><a href="#">iPhone</a></li>
						<li><a href="#">Samsung</a></li>
						<li><a href="#">Nokia</a></li>
						<li><a href="index.php?page=all">All</a></li>
					</ul>
				</li>
                <li><a href="index.php?page=contact">Contact us</a></li>
                <li><a href="#">Cart</a></li>
			</ul>
        </div>
        <div class="container">
            <?php include $page; ?>
        </div>
	</body>
</html>