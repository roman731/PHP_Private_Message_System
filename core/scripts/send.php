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
			echo '<div class="msg success">Message sent.</div>';
		}
		else
		{
			echo '<div class="msg error">Message wasn\'t sent.</div>';
		}
	}
	else
	{
		echo '<div class="msg error">No message was entered.</div>';
	}
}
else
{
	echo '<div class="msg error">No name was entered.</div>';
}

?>