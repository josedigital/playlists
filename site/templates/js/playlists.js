$(document).ready(function() {

	//player
    var settings = {
        progressbarWidth: '380px',
        progressbarHeight: '10px',
        progressbarColor: '#8dd9f2',
        progressbarBGColor: '#999',
        defaultVolume: 0.8
    };
    $(".player").player(settings);
    






	$('.simpleplayer-play-control').click(function() {
			var song = $(this).parents('.song').find('audio').attr('src');
			var song = $(this).parents('.song').find('audio').get(0);

			/* GET SONG PARAMETERS FROM API
			rem = parseInt(song.duration - song.currentTime, 10),
			pos = (song.currentTime / song.duration) * 100,
			mins = Math.floor(rem/60,10),
			secs = rem - mins*60;
			*/
	});
		
		

	//get time, duration, display it
	$('audio').bind('timeupdate', function() {
		var song = $(this).get(0);
		duration = $(this).parents('.song').find('.time');
		//fireduration.html(song.duration);
			var s = parseInt(song.currentTime % 60);
			var m = parseInt((song.currentTime / 60) % 60);
			duration.html(m + ':' + s + ' sec / ' + parseInt(song.duration)/60);
				
			
			//play next when song ends
			if(song.currentTime == song.duration)
			{
				$(this).parents('.song').next('.song').find('.simpleplayer-play-control').click();
			}

				
	}, false);


});
