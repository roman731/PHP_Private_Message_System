<?php
	
	

	$errors = array();

	if(isset($_GET['delete_conversation']))
	{
		if (validate_conversation_id($_GET['delete_conversation']) === false)
		{
			$errors = 'Invalid conversation ID';
		}
		if(empty($errors))
		{
			delete_conversation($_GET['delete_conversation']);
		}
	}

	$conversations = fetch_conversation_summary();

	if(empty($conversations))
	{
		$error[] = 'You have no messages.';
	}

	if(empty($errors) === false)
	{
		foreach($errors as $error)
		{
			echo '<div class="msg error">', $error, '</div>';
		}
	}
?>

<div>
<a href="index.php?page=new_conversation">New Conversation</a>
<a href="index.php?page=group_chat">Group Chat</a>
<a href="index.php?page=logout" style="float: right;">Logout</a>
</div>

<div class="conversations">
	<?php
		foreach ($conversations as $conversation)
		{
			?>
			<div class="conversation <?php if ($conversation['unread_messages']) echo 'unread'; ?>">
				<h2>
					<a href="index.php?page=inbox&amp;delete_conversation=<?php echo $conversation['id']; ?>">[x]</a>
					<a href="index.php?page=view_conversation&amp;conversation_id=<?php echo $conversation['id']?>"><?php echo $conversation['subject']; ?>
				</h2>
				<p>Last Reply: <?php echo date('d/m/Y h:i:s A', $conversation['last_reply']); ?></p>
			</div>
			<?php
		}
	?>


</div>