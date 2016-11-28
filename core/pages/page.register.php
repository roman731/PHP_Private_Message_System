<?php


	$errors = array();

	if(isset($_POST['username'], $_POST['password'], $_POST['repeat_password']))
	{
		if (empty($_POST['username']))
		{
			$errors[] = 'The username cannot be empty.';
		}

		if (empty($_POST['password']) || empty($_POST['repeat_password']))
		{
			$errors[] = 'The password cannot be empty.';
		}

		if($_POST['password'] !== $_POST['repeat_password'])
		{
			$errors[] = 'The passwords you entered do not match.';
		}

		if(db_user_exists($_POST['username']))
		{
			$errors[] = 'That username is not avaliable.';
		}

		if(empty($errors))
		{
			db_add_user($_POST['username'], $_POST['password']);

			$_SESSION['username'] = htmlentities($_POST['username']);

			header('Location: index.php?page=inbox');
			die();
		}
	}

?>


<html lang="EN">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="ext/css/main.css" />
		<title>Roman's PHP Private Message App. </title>
	</head>
	<body>
		<div>
			<?php

				if(empty($errors) === false)
				{
					?>
					<ul>

						<?php

						foreach ($errors as $error)
						{
							echo "<li>{$error}</li>";
						}
						?>

					</ul>
					<?php
				}

			?>
		</div>
		<form action="" method="post">
			<p>
				<label for="username">Username:</label>
				<input type="text"  name="username" id="username" autocomplete="off" value="<?php if (isset($_POST['username'])) echo htmlentities($_POST['username']); ?>"/>
			</p>
			<p>
				<label for="password">Password:</label>
				<input type="password" name="password" id="password" />
			</p>
			<p>
				<label for="repeat_password">Repeat Password:</label>
				<input type="password" name="repeat_password" id="repeat_password" />
			</p>
			<p>
				<input type="submit" value="Register" />
			</p>
		</form>
		
	</body>
</html>