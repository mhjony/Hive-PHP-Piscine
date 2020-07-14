<?php
	if ($_POST["login"] == "" || $_POST["passwd"] == "" || $_POST["submit"] !== "OK")
	{
		echo "ERROR\n";
		return ;
	}

	if (!file_exists("../private/passwd") || !file_exists("../passwd"))
	{
		mkdir("../private");
	}

	if (file_exists("../private/passwd"))
	{
		$users = unserialize(file_get_contents("../private/passwd"));
		//print_r($users);
		foreach ($users as $user)
		{
			if ($user["login"] == $_POST["login"])
			{
				echo "ERROR\n";
				return ;
			}
		}
	}
	$arr["login"] = $_POST["login"];
	$arr["passwd"] = hash('whirlpool', $_POST["passwd"]);
	$tab[] = $arr;
	file_put_contents("../private/passwd", serialize($tab));
	echo "OK\n";
?>
