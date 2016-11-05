$(document).ready(function() {

	$('#login-form').ajaxForm({
		target: '#add-playlist',
		
		success: function() {
			$('#login-form').fadeOut('fast', function() {
				$('#add-playlist').fadeIn('fast');
			});
		}
	
	});


	
	$('#loginform').load('login/index');

    
});
