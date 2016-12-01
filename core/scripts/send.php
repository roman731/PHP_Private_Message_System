<?php

require('../../core/db/db.connect.php');
require('../../core/db/db.chat.php');


if(isset($_GET['sender']) && !empty($_GET['sender']))
{
	$sender = $_GET['sender'];
		

	if(isset($_GET['message'])&&!empty($_GET['message']))
	{
		$message = $_GET['message'];



		if(db_chat_send_msg($sender, $message))
		{
			echo 'Message sent.';
		}
		else
		{
			echo 'Message wasn\'t sent.';
		}
	}
	else
	{
		echo 'No message was entered';
	}
}
else
{
	echo 'No name was entered.';
}

?>