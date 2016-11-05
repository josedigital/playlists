<div class="container" id="bottom">


	<div class="row" id="footer">
	
		<ul>
			<li><a href="#">home</a></li>
			<li><a href="#">playlists</a></li>
			<li><a href="#">about</a></li>
			<li><a href="#">login</a></li>
		</ul>

		<p>all songs copyright by their respective authors. all bought with our own money.</p>
	
	</div>


</div><!-- /container#bottom -->

















	<?php
	
	/*
	#previous playlists
	
	$playlists = $pages->get('/playlists/')->children("limit=10, sort=-created, start=1");
	
	foreach($playlists as $playlist)
		{
			echo "
			<ul>
			<li><a href='{$playlist->url}'>{$playlist->title}</a><p>by {$playlist->get("createdUser")->name}<br>" . date('M d Y', $playlist->get("created")) . "</p></li>
			</ul>
			";
	    }
	*/
	?>



<!-- here comes the javascript -->

<!-- Grab Google CDN's jQuery. fall back to local if necessary -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script>window.jQuery || document.write("<script src='js/jquery-1.5.1.min.js'>\x3C/script>")</script>
<script src="js/jquery.reveal.js"></script>


<!-- this is where we put our custom functions -->
<script type="text/javascript" src="<?php echo $config->urls->templates?>js/jquery.simpleplayer.js"></script>
<script type="text/javascript" src="<?php echo $config->urls->templates?>js/playlists.js"></script>

<!-- Asynchronous google analytics; this is the official snippet.
	 Replace UA-XXXXXX-XX with your site's ID and uncomment to enable.
	 
<script>

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-XXXXXX-XX']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
-->
	</body>
</html>
