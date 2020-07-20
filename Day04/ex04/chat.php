<?php
session_start();
if (!($_SESSION['loggued_on_user']))
	echo "ERROR\n";
else
{
	if (file_exists('../private/chat'))
	{
		$chats = unserialize(file_get_contents('../private/chat'));
		foreach ($chats as $chat)
		{
			echo date('m/Y H:i',$chat['time']).' ' .'<b>' .$chat['login']. ':'. '</b>'. $chat['msg'] .'<br />';
		}
	}
}
?>