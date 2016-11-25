<?php

	//fetches a summary of conversations
	function fetch_conversation_summary()
	{
		$sql = "SELECT 
					`conversations`.`conversation_id`,
					`conversations`.`conversation_subject`,
					MAX(`conversations_messages`.`message_date`) AS `conversation_last_reply`,
					MAX(`conversations_messages`.`message_date`) > `conversations_members`.`conversation_last_view` AS `conversation_unread`
				FROM `conversations`
				LEFT JOIN `conversations_messages` ON `conversations`.`conversation_id` = `conversations_messages`.`conversation_id`
				INNER JOIN `conversations_members` ON `conversations`.`conversation_id` = `conversations_members`.`conversation_id`
				WHERE `conversations_members`.`user_id` = {$_SESSION['user_id']}
				AND `conversations_members`.`conversation_deleted` = 0
				GROUP BY `conversations`.`conversation_id`
				ORDER BY `conversation_last_reply` DESC ";

		$result = mysql_query($sql);

		$conversations = array();

		while(($row = mysql_fetch_assoc($result)) !== false)
		{
			$conversations[] = array(
					'id' 				=> $row['conversation_id'],
					'subject' 			=> $row['conversation_subject'],
					'last_reply'		=> $row['conversation_last_reply'],
					'unread_messages'	=> ($row['conversation_unread'] == 1),
				);
		}

		return $conversations;
	}

	//fetches all of the messages in the given conversation
	function fetch_conversation_messages($conversation_id)
	{
		$conversation_id = (int)$conversation_id;

		 $sql = "SELECT 
		 			`conversations_messages`.`message_date`,
		 			`conversations_messages`.`message_date` > `conversations_members`.`conversation_last_view` AS `message_unread`,
		 			`conversations_messages`.`message_text`,
		 			`users`.`user_name`
		 		FROM `conversations_messages`
		 		INNER JOIN `users` ON `conversations_messages`.`user_id` = `users`.`user_id`
		 		INNER JOIN `conversations_members` ON `conversations_messages`.`conversation_id` = `conversations_members`.`conversation_id`
		 		WHERE `conversations_messages`.`conversation_id` = {$conversation_id}
		 		AND `conversations_members`.`user_id` = {$_SESSION['user_id']}
		 		ORDER BY `conversations_messages`.`message_date` DESC" ;

		 $result = mysql_query($sql);

		 $messages = array();

		 while(($row = mysql_fetch_assoc($result)) !== false)
		 {
		 	$messages[] = array(
		 			'date'		=> $row['message_date'],
		 			'unread'	=> $row['message_unread'],
		 			'text'		=> $row['message_text'],
		 			'user_name' => $row['user_name'],
		 		);
		 }

		 return $messages;
	}
	// Sets the last view time to be the current time for the given conversation.
	function update_conversation_last_view($conversation_id)
	{
		$conversation_id = (int)$conversation_id;

		$sql = "UPDATE `conversations_members`
				SET `conversation_last_view` = UNIX_TIMESTAMP()
				WHERE `conversation_id` = {$conversation_id}
				AND `user_id` = {$_SESSION['user_id']}";

		mysql_query($sql);
	}
	
	//creates a conversation making the given users a member. 
	function create_conversation($user_ids, $subject, $body)
	{
		$subject	 = mysql_real_escape_string(htmlentities($subject));
		$body 		 = mysql_real_escape_string(htmlentities($body));

		mysql_query("INSERT INTO `conversations` (`conversation_subject`) VALUES ('{$subject}')");

		$conversation_id = mysql_insert_id();

		$sql = "INSERT INTO `conversations_messages` (`conversation_id`, `user_Id`, `message_date`, `message_text`)
		VALUES ({$conversation_id}, {$_SESSION['user_id']}, UNIX_TIMESTAMP(), '{$body}')";

		mysql_query($sql);

		$values = array("({$conversation_id}, {$_SESSION['user_id']}, UNIX_TIMESTAMP(), 0)");



		foreach($user_ids as $user_id)
		{
			$user_id = (int) $user_id;
			$values[] = "({$conversation_id}, {$user_id}, 0, 0)";
		}

		$sql = "INSERT INTO `conversations_members` (`conversation_id`, `user_id`, `conversation_last_view`, `conversation_deleted`)
		VALUES " . implode(", ", $values);

		mysql_query($sql);
	}

	//check to see if the given user is a member of the given conversation
	function validate_conversation_id($conversation_id)
	{
		$conversation_id = (int)$conversation_id;

		$sql = "SELECT COUNT(1)
				FROM `conversations_members` 
				WHERE `conversation_id` = {$conversation_id}
				AND `user_id` = {$_SESSION['user_id']}
				AND `conversation_deleted` = 0";

		$result = mysql_query($sql);

		return (mysql_result ($result, 0) == 1);
	}

	//adds a message to the given conversation
	function add_conversation_message($conversation_id, $text)
	{
		$conversation_id = (int)$conversation_id;
		$text = mysql_real_escape_string(htmlentities($text));

		$sql = "INSERT INTO `conversations_messages` (`conversation_id`, `user_id`, `message_date`, `message_text`)
				VALUES ({$conversation_id}, {$_SESSION['user_id']}, UNIX_TIMESTAMP(), '{$text}') ";

		mysql_query($sql);

		//mysql_query("UPDATE `conversations_members` SET `conversation_deleted` = 0 WHERE `conversation_id` = {$conversation_id}");
	}

	// deletes a given conversation
	function delete_conversation($conversation_id)
	{
		$conversation_id = (int)$conversation_id;

		$sql = "SELECT DISTINCT `conversation_deleted`
				FROM `conversations_members`
				WHERE `user_id` != {$_SESSION['user_id']}
				AND `conversation_id` = {$conversation_id}";

		$result = mysql_query($sql);

		if(mysql_num_rows($result) === 1 && mysql_result($result, 0) == 1)
		{
			mysql_query("DELETE FROM `conversations` WHERE `conversation_id` = {$conversation_id}");
			mysql_query("DELETE FROM `conversations_members` WHERE `conversation_id` = {$conversation_id}");
			mysql_query("DELETE FROM `conversations_messages` WHERE `conversation_id` = {$conversation_id}");
		}
		else
		{
			$sql = "UPDATE `conversations_members`
			SET `conversation_deleted` = 1
			WHERE `conversation_id` = {$conversation_id}
			AND `user_id` = {$_SESSION['user_id']}";

			mysql_query($sql);
		}
	}

?>