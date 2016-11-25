<h1>Login</h1>

<?php

if(isset($_POST['user_name'], $_POST['user_password']))
{
	echo '<div class="msg error">Login failed.</div>';
}

?>

<form action="index.php?page=login" method="POST">

<div>
	<label for="user_name">Name</label>
	<input type="text"  name="user_name" id="user_name"  autocomplete="off"/>
</div>
<div>
	<label for="user_password">Password</label>
	<input type="password" name="user_password" id="user_password"
</div>
<div>
	<input type="submit" value="Login" />
</div>
</form>