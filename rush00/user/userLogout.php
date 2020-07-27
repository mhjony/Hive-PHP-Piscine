<?PHP
session_start();
unset($_SESSION['user']);
$_SESSION['user'] = NULL;
unset($_SESSION['cart']);
$_SESSION['cart'] = NULL;
if (!($_SESSION['user']))
{
	header('Location: index.php');
}
?>
