<?php

	function db_chat_get_msg()
	{
	  	$query = "SELECT Sender, Message FROM chat ORDER BY Msg_ID DESC";

		$run = mysql_query($query);
		if (!$run) {
    		die('Invalid query: ' . mysql_error());
		}

		$messages = array();

		while($message = mysql_fetch_assoc($run))
		{
			$messages[] = array('sender'=>$message['Sender'],
								'message'=>$message['Message']);
		}
		return $messages; 
	}

	function db_chat_send_msg($sender, $message)
	{
		if(!empty($sender) && !empty($message))
		{
			$sender = mysql_real_escape_string($sender);
			$message = mysql_real_escape_string($message);

			$query = "INSERT INTO chat VALUES (null, '$sender', '$message')";

			if($run = mysql_query($query))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}	
?>