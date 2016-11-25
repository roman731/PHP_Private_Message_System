<?php

require('../../core/db/db.connect.php');
require('../../core/db/db.chat.php');

$messages = db_chat_get_msg();

foreach($messages as $message)
{
	echo '<strong>'.$message['sender'].' :</strong><br />';
	echo $message['message'].'<br /><br />';
}

?>