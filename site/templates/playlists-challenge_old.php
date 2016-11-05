<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>weekly playlists</title>

	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="robots" content="" />

	<!-- Mobile Specific Metas
	================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
	
	<link href="<?php echo $config->urls->templates?>css/grid.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="<?php echo $config->urls->templates?>css/styles.css" media="screen" rel="stylesheet" type="text/css" />
	<link href='http://fonts.googleapis.com/css?family=Antic|Quattrocento' rel='stylesheet' type='text/css'>

	

    <link href="<?php echo $config->urls->templates?>css/player.css" rel="stylesheet" type="text/css"/>


<style>


<?php 
if($page->background_image->first())
{
	echo '
	/* *, #header h1, h1, h2, h3, h4, h5, h6, p {text-shadow: none; color: #ccc;} 
	#content {background: url("' . $config->urls->templates . 'images/transbg.png") 0 0 repeat;} */
	body {
		background: #e3e3e3 url("' . $page->background_image->first()->url . '") no-repeat center 0 fixed;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}
	.container {
		z-index: 1;
		/*position: fixed;*/
		top: 0;
		bottom: 0;
		right: 0;
		left: 0;
		width: 100%;
		height: 100%;
		min-height: 1000px;

		background: -moz-linear-gradient(top,  rgba(34,34,34,0) 0%, rgba(34,34,34,1) 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(34,34,34,0)), color-stop(100%,rgba(34,34,34,1))); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top,  rgba(34,34,34,0) 0%,rgba(34,34,34,1) 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top,  rgba(34,34,34,0) 0%,rgba(34,34,34,1) 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top,  rgba(34,34,34,0) 0%,rgba(34,34,34,1) 100%); /* IE10+ */
		background: linear-gradient(to bottom,  rgba(34,34,34,0) 0%,rgba(34,34,34,1) 100%); /* W3C */


		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
}
	';
	
}
?>


</style>

</head>
<body class="<?=$page->template->name;?>">
<div class="container">

<div id="top-bar">
	<h1>by hds</h1>
</div>


<div  class="row">

	<div id="header">
		<h1><?=$page->title;?></h1>
		<h5>by <?php echo $page->createdUser->name; ?></h5>
	</div>


	<div id="content">

	<?php include('./mp3Data.class.php'); ?>

	<?php if($page->parent->name != 'playlists') : ?>
	<div id="response">
		<h4>
		in response to <span class="challenge-name"><a href="<?php echo $page->parent->url; ?>"><?php echo $page->parent->name; ?></a></span>
		</h4>
	</div>
	<?php endif; ?>
	
	<div id="commentary">
	<?php echo $page->body; ?>
	</div>
		


				<audio preload></audio>
				<ol class="playlist">

		<?php

		$songs = $page->mp3;
			$x = 1;
			foreach ($songs as $song)
					{
						$data = new mp3Data($songs->path . $song);

						if($data->getName() == "") 
						{ 
							echo '<li>no metadata available for this file.</li>';
						}
						else 
						{

				$single = ($x < 10) ? ' class="single"' : '';
				echo '
					<li'. $single . '>
						<a href="#" data-src="' . $song->url . '">
							<span class="song-name">' . $data->getName() . '</span> 
							by 
							<span class="artist-name">' . $data->getArtist() . '</span> 
							from the album 
							<span class="album-name">' . $data->getAlbum() . '</span>
						</a>
					</li>';
						}
					$x++;
					}
		?>
				</ol>		



		<div class="row" id="responses">
		
		<?php
		if($page->numChildren > 0)
		{
			echo '
			<h4>challenge responses:</h4>
			';
			$childs = $page->children;
			foreach($childs as $child)
			{
				echo '<p><a href="' . $child->url . '">' . $child->name . '</a> by ' . $child->createdUser->name . '</p>';
			}
		}
		?>
		
		</div><!-- /responses -->


		<?php

		if($user->name === $page->createdUser->name)
		{
			if($page->mp3->count() < 22)
			{
				include 'add_songs_form.inc';
			}
		}
		else
		{
			if($user->isLoggedin())
			{
				echo '<h3>respond to this challenge with your own playlist</h3>';
				include 'add_playlist.inc';
			}
			
		}


		?>		
				





	</div><!-- /content -->

</div><!-- /row -->
	
	



</div><!-- /container -->




<!-- Grab Google CDN's jQuery. fall back to local if necessary -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script>window.jQuery || document.write("<script src='js/jquery-1.4.2.min.js'>\x3C/script>")</script>


	<!-- <script type="text/javascript" src="<?php echo $config->urls->templates?>js/jquery.simpleplayer.js"></script> -->
	<!-- <script type="text/javascript" src="<?php echo $config->urls->templates?>js/playlists.js"></script> -->
	<script type="text/javascript" src="<?php echo $config->urls->templates?>js/audio.min.js"></script>
	<script type="text/javascript" src="<?php echo $config->urls->templates?>js/playlist.js"></script>
</body>
</html>
