$(document).ready(function(){


	var interval = setInterval(function(){
		$.ajax({
			url: 'core/scripts/Chat.php',
			success: function(data){
				$('#messages').html(data);
			}
		}); 

	}, 1000); 

	
});