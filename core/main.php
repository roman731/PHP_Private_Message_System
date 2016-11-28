<?php

$core_path = dirname(__FILE__);

require("{$core_path}/db/db.connect.php");
require("{$core_path}/db/db.user.php");
require("{$core_path}/db/db.conversations.php");
require("{$core_path}/db/db.chat.php");

if (empty($_GET['page']) || in_array("page.{$_GET['page']}.php", scandir("{$core_path}/pages")) == false)
{
	header('HTTP/1.1 404 Not Found');
	header('Location: index.php?page=inbox');
	die();
}

session_start();

if(isset($_POST['user_name']))
{
		if(($user_id = db_user_validate_credentials($_POST['user_name'], $_POST['user_password'])) !== false)
	{
		$_SESSION['user_id'] = $user_id;

		header('Location: index.php?page=inbox');

		die();
	}
}

//if they're not logged in
if(empty($_SESSION['user_id']) && $_GET['page'] !== 'login' && $_GET['page'] !== 'register')
{
	header('HTTP/1.1 403 Forbidden');
	header('Location: index.php?page=login');
	die();
}

$include_file = "{$core_path}/pages/page.{$_GET['page']}.php";

?>