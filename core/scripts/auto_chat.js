$(document).ready(function(){


	var interval = setInterval(function(){
		console.log("here");
		$.ajax({
			url: 'core/scripts/Chat.php',
			success: function(data){
				$('#messages').html(data);
			}
		}); 

	}, 1000); 

	
});