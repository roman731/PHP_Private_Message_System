
<?php

if(isset($_POST['user_name'], $_POST['user_password']))
{
	echo '<div class="msg error">Login failed.</div>';
}

?>
<div class="jumbotron">
  <h1>Private Message System</h1>
  <p>PrivateMessageSystem is a messaging system made in PHP which allows users to log into their account and have conversations with other users. Visit the GitHub page for more information.</p>
  <p><a class="btn btn-primary btn-lg" style="color: white; text-decoration: none;" href="https://github.com/roman731/PHP_Private_Message_System">GitHub Source</a></p>
</div>
<form action="index.php?page=login" class="form-horizontal" method="POST">
<fieldset>
<h2>Login</h2>
<hr>
<div>
	<label for="user_name">Name</label>
	<input type="text"  name="user_name" id="user_name"   autocomplete="off" class="form-control" style="width:172px; height: 35px;" />
</div>
<div>
	<label for="user_password">Password</label>
	<input type="password" name="user_password" id="user_password" class="form-control" style="width:172px; height: 35px;"/>
</div>
<div>
	<input type="submit" class="btn btn-primary" value="Login" />
</div>
<br />
<div>
	<a href="index.php?page=register">Need to register? Click here.</a>
</div>
</fieldset>
</form>