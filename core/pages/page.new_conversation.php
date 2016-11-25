<?php


	if(isset($_POST['to'], $_POST['subject'], $_POST['body']))
	{
		$errors = array();

		if(empty($_POST['to']))
		{
			$errors[] = 'You must enter at least one name.';
		}
		else if(preg_match('#^[a-z, ]+$#i', $_POST['to']) == 0)
		{
			$errors[] = 'The list of names is invalid.';
		}
		else
		{
			$user_names = explode(',', $_POST['to']);

			foreach($user_names as &$name)
			{
				$name = trim($name);
			}

			$user_ids = db_user_fetch_ids($user_names);

			if(count($user_ids) !== count($user_names))
			{
				$errors[] = 'The following users could not be found: ' . implode(', ', array_diff($user_names, array_keys($user_ids)));
			}
		}


		if(empty($_POST['subject']))
		{
			$errors[] = 'The subject cannot be empty.';
		}
		if(empty($_POST['body']))
		{
			$errors[] = 'The body cannot be empty.';
		}

		if(empty($errors))
		{
			create_conversation(array_unique($user_ids), $_POST['subject'], $_POST['body']);
		}
	}


	if(isset($errors))
	{
		if(empty($errors))
		{
			echo '<div class="msg success">Your message has been sent <a href="index.php?page=inbox">Return to your inbox</a></div>';
		}
		else
		{
			foreach ($errors as $error)
			{
				echo '<div class="msg error">', $error, '</div>';
			}
		}
	}

?>
<a href="index.php?page=inbox" style="float:right;">Back</a>

<form action="" method="POST">
	<div>
		<label for="to">To</label>
		<input type="text" name="to" id="to" autocomplete="off" value="<?php if(isset($_POST['to'])) echo htmlentities($_POST['to']); ?>" />
	</div>
	<div>
		<label for="subject">Subject</label>
		<input type="text" name="subject" id="subject" autocomplete="off" value="<?php if(isset($_POST['subject'])) echo htmlentities($_POST['subject']); ?>"/>
	</div>
	<div>
		<textarea name="body" rows="20" cols="110"><?php if(isset($_POST['body'])) echo htmlentities($_POST['body']); ?></textarea>
	</div>
	<div>
		<input type="submit" value="send" />
	</div>
</form>