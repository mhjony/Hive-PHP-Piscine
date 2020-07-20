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
	$tmp['login'] = $_POST['login'];
    $tmp['passwd'] = hash('whirlpool', $_POST['passwd']);
    $account[] = $tmp;
    file_put_contents('../private/passwd', serialize($account));
    header('Location: index.html');
    echo "OK\n";
?>