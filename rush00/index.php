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
    $page = "items/items.php";
}

if ($_GET['page'] == "nokia")
{
    $page = "items/items.php";
}

if ($_GET['page'] == "samsung")
{
    $page = "items/items.php";
}

if ($_GET['page'] == "apple")
{
    $page = "items/items.php";
}

if ($_GET['page'] == "new_user")
{
    $page = "user/createuser.php";
}

if ($_GET['page'] == "login") {
	$page = "user/login.php";
}

if ($_GET['page'] == "userHome") {
	$page = "user/userHome.php";
}

if ($_GET['page'] == "userLogout") {
	$page = "user/userLogout.php";
}

if ($_GET['page'] == "userDel") {
	$page = "user/userDel.php";
}

if ($_GET['page'] == "alogin") {
	$page = "admin/adminLogin.php";
}

if ($_GET['page'] == "modif") {
	$page = "application/authorization/modif.php";
}

if ($_GET['page'] == "logout") {
	$page = "application/authorization/logout.php";
}

if ($_GET['page'] == "cart")
{
    $page = "items/cart.php";
}

$conn = mysqli_connect("localhost", "root", "123456", "rush00");

if (mysqli_connect_errno()){
	try{
		include("install.php");
	}
	catch(mysql_sql_exception $exp)
	{
		echo "Connection failed\n";
		exit();
	}
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
                <li><a href="index.php?page=all">Category</a>
					<ul>
						<li><a href="index.php?page=apple">Apple</a></li>
						<li><a href="index.php?page=samsung">Samsung</a></li>
						<li><a href="index.php?page=nokia">Nokia</a></li>
						<li><a href="index.php?page=all">All</a></li>
					</ul>
				</li>
                <li><a href="index.php?page=contact">Contact us</a></li>
                <li><a href="index.php?page=cart">Cart</a></li>
				<li><a href="#">User</a>
					<ul>
						<li><a href="index.php?page=login">User Login</a></li>
						<li><a href="index.php?page=alogin">Admin Login</a></li>
						<li><a href="index.php?page=new_user">Create User</a>
						<?php
					if (isset($_SESSION['user']) AND $_SESSION['user']['name'] != NULL AND $_SESSION['user']['name'] != "") {
                        echo "<li><a href=\"index.php?page=userHome\">".$_SESSION['user']['name']."</a></li>";
                        echo "<li><a href=\"index.php?page=userLogout\">Logout</a></li>";
                    }
                ?>
			</ul>
        </div>
        <div class="container">
            <?php include $page; ?>
        </div>
	</body>
</html>