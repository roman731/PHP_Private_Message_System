$('#form_input').submit(function(){
	var message = $('#message').val();
	var sender = $('#sender').val();

	$.ajax({
		url: 'core/scripts/Send.php',
		data: { sender: sender, message: message},
		success: function(data){
			$('#feedback').html(data);

			$('#feedback').fadeIn('slow', function(){
				$('#feedback').fadeOut(4500);
			});

			$('#message').val('');
		}
	});
	return false;
});