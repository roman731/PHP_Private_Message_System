<?php

//require('core/main.php');



?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Roman's PHP Chat App</title>

	</head>
	<body>
	<a href="index.php?page=inbox" style="float: right;">Back</a>
		<div id="input">
			<div id="feedback" ></div>
			<form action="#" method="post" id="form_input">
					<input type="hidden" name="sender" id="sender" value="<?php echo $_SESSION['user_name']; ?>" />
					<label>Enter Message:<br /><textarea class="form-control" id="message" cols="50" rows="4"></textarea></label><br /><br />
					<input type="submit" class="btn btn-success" name="send" value="Send Message" id="send" />
			</form>
		</div>

		<div id="messages" class="form-control">
		</div> <!-- close Messages -->

		<!-- Javascript -->
		<script type="text/javascript" src="core/scripts/jquery-3.1.1.min.js"></script>
		
		<script type="text/javascript" src="core/scripts/auto_chat.js"></script>
		<script type="text/javascript" src="core/scripts/send.js"></script>

	</body>
</html>