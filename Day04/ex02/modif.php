<?php
if ($_POST["login"] == "" || $_POST["oldpw"] == "" || $_POST["newpw"] == "" || $_POST["submit"] !== "OK")
{
	echo "ERROR\n";
	return ;
}

$users = unserialize(file_get_contents("../private/passwd"));
$count = 0;
foreach($users as $key => $user)
{
	if ($user["login"] == $_POST["login"])
	{
		$oldpw_hash = hash('whirlpool',$_POST["oldpw"]);
		if ($user["passwd"] == $oldpw_hash)
		{
			$count = 1;
			$users[$key]["passwd"] = hash('whirlpool', $_POST["newpw"]);
		}
		else
		{
			echo "ERROR\n";
			return ;
		}
	}
}
if ($count == 1)
{
	file_put_contents("../private/passwd", serialize($users));
	echo "OK\n";
}
else
{
	echo "ERROR\n";
}

?>