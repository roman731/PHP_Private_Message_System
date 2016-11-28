<?php
//if username and password successfully match, return the first row (the user_id)
function db_user_validate_credentials($user_name, $user_password)
{
	$user_name = mysql_real_escape_string($user_name);
	$user_password = sha1($user_password);

	$result = mysql_query("SELECT `user_id` FROM `users` WHERE `user_name` = '{$user_name}' AND `user_password` = '{$user_password}'");

	if(mysql_num_rows($result) != 1)
	{
		return false;
	}

	return mysql_result($result, 0);
}

function db_user_fetch_ids($user_names)
{
	foreach ($user_names as &$name)
	{
		$name = mysql_real_escape_string($name);
	}

	$result = mysql_query("SELECT `user_id`, `user_name` FROM `users` WHERE `user_name` IN ('". implode("', '", $user_names) . "')");

	$names = array();

	while(($row = mysql_fetch_assoc($result)) !== false)
	{
		$names[$row['user_name']] = $row['user_id'];
	}

	return $names;
}

//checks if given username already exists
function db_user_exists($user)
{
	$user = mysql_real_escape_string($user);
	$result = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `user_name` = '{$user}'");

	return (mysql_result($result, 0) == '1') ? true : false;
}

function db_add_user($user, $pass)
{
	$user = mysql_real_escape_string(htmlentities($user));
	$pass = sha1($pass);

	mysql_query("INSERT INTO `users` (`user_name`, `user_password`) VALUES ('{$user}', '{$pass}')");
}

?>