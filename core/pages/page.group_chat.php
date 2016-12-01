<?php

//require('core/main.php');


//echo "test2: {$_SESSION['user_name']}";


?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Roman's PHP Chat App</title>
		<!-- <link rel="stylesheet" type="text/css" href="../ext/css/main.css" /> -->

	</head>
	<body>
	<a href="index.php?page=inbox" style="float: right;">Back</a>
		<div id="input">
			<div id="feedback" ></div>
			<form action="#" method="post" id="form_input">
					<label>Enter Name:<input type="text" name="sender" id="sender" autocomplete="off" /></label><br />
					<label>Enter Message:<br /><textarea id="message" cols="50" rows="4" style="resize:none"></textarea></label><br /><br />
					<input type="submit" name="send" value="Send Message" id="send" />
			</form>
		</div>

		<div id="messages">
			
		</div> <!-- close Messages -->

		<!-- Javascript -->
		<script type="text/javascript" src="core/scripts/jquery-3.1.1.min.js"></script>
		
		<script type="text/javascript" src="core/scripts/auto_chat.js"></script>
		<script type="text/javascript" src="core/scripts/send.js"></script>

	</body>
</html>