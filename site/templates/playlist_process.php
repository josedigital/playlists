<!DOCTYPE html>

<html lang="en">
<head>
	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">

	<title>enter the mixtagon</title>
	
	<!-- Meta tags -->
	<meta name="keywords" content="" />
	<meta name="robots" content="" />
	<meta name="title" content="">
	<meta name="description" content="">

	<meta name="author" content="Your Name Here">
	<meta name="Copyright" content="Copyright Your Name Here 2011. All Rights Reserved.">

	<!-- Google will often use this as its description of your page/site. Make it good. -->
	
	<meta name="google-site-verification" content="">

	<!-- Speaking of Google, don't forget to set your site up: http://google.com/webmasters -->

	<!-- Mobile Specific Metas
	================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
	
	
	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png" />
	<link rel="shortcut icon" href="images/favicon.ico">
	

	<!-- CSS
  ================================================== -->
	<link href="<?php echo $config->urls->templates?>css/grid.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="<?php echo $config->urls->templates?>css/styles.css" media="screen" rel="stylesheet" type="text/css" />


	<!-- Fonts
  ================================================== -->
	<link href='http://fonts.googleapis.com/css?family=Antic|Quattrocento' rel='stylesheet' type='text/css'>

<style>
/*
body {
	background: url() no-repeat center 20px fixed;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
      }
*/
</style>

</head>
<body>
<div class="container" id="main">
	
	
		<div class="row" id="header">
			<div class="sixcol">
				<img src="<?php echo $config->urls->templates?>img/logo.png" alt="Enter the Mixtagon" />
			</div><!-- /6 -->
			


			<div class="sixcol last">
				<ul id="nav">
					<li><a href="#">home</a></li>
					<li><a href="#">playlists</a></li>
					<li><a href="#">about</a></li>
					<li><a href="#">login</a></li>
				</ul>
			</div>



			
		</div><!-- /#header -->
		




		<div class="row">


			<h2>user admin</h2>

			<?php

				$path = $config->paths->assets;





				for($i=0;$i<count($_FILES['file']['size']);$i++) {

					if(strstr($_FILES['file']['type'][$i], 'audio')!==false) {

						$file = $path . '/' .$_FILES['file']['name'][$i];

						//move_uploaded_file($_FILES['file']['tmp_name'][$i],$file);

						if(move_uploaded_file($_FILES['file']['tmp_name'][$i],$file)) {
							//adds file to assets -> page directory
							$page->mp3->add($file);
							//sets name of file to mp3 field
							$page->set('mp3',$_FILES['file']['name'][$i]);
							//save page
							$page->setOutputFormatting(false);
							$page->save();

							// success message
							echo '<p>your files have been uplaoded.</p>';

						} else 
						{ 
							echo 'something went wrong with your uploads. please try again.'; 
						}
							
					}
				}






			?>


		</div>

















</div><!-- /container#main -->





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
