<?php
function auth($login, $passwd)
{
	$users = unserialize(file_get_contents("../private/passwd"));
	foreach ($users as $user)
	{
		if ($user["login"] === $login && $user["passwd"] === hash('whirlpool', $passwd))
			return TRUE;
	}
	return FALSE;
}
?>