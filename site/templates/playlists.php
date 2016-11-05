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
	
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	

    <link href="<?php echo $config->urls->templates?>css/player.css" rel="stylesheet" type="text/css"/>
	<!-- <script type="text/javascript" src="<?php echo $config->urls->templates?>js/jquery.simpleplayer.js"></script> -->
	<!-- <script type="text/javascript" src="<?php echo $config->urls->templates?>js/playlists.js"></script> -->
	<script type="text/javascript" src="<?php echo $config->urls->templates?>js/audio.min.js"></script>
	<script type="text/javascript" src="<?php echo $config->urls->templates?>js/playlist.js"></script>

<style>


<?php 
if($page->background_image->first())
{
	echo '
	/* *, #header h1, h1, h2, h3, h4, h5, h6, p {text-shadow: none; color: #ccc;} 
	#content {background: url("' . $config->urls->templates . 'images/transbg.png") 0 0 repeat;} */
	body {
		background: #e3e3e3 url("' . $page->background_image->first()->url . '") no-repeat center 20px fixed;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}';
	
} else {
	echo '
	#header h1, h1, h2, h3, h4, h5, h6, p {text-shadow: none; color: #444; } 
	';
}
?>


</style>

</head>
<body>
<div class="container">

<div id="top-bar">
	<h1>by hds</h1>
</div>



<div  class="row">

	<div id="playlist-header">
		<h1><?=$page->title;?></h1>
		
	</div>


	<div id="content">

	
	
	<div id="commentary">
	<?php echo $page->body; ?>
	</div>
		

				
		
		<div class="row" id="all-playlists-responses">
		
		<?php
		function getchilds($pagina)
		{
			foreach ($pagina as $p) {
				echo '<li>
						<p><a href="' . $p->url . '">' . $p->name . '</a> by ' . $p->createdUser->name . '</p>
					';
					if($p->numChildren > 0)
					{
						echo '<ul>';
						$childs = $p->children;
						getchilds($childs);
						echo '</ul>';
					}
				echo '</li>';
			}
		}


		if($page->numChildren > 0)
		{
			echo '
			<h4>All Playlists and responses</h4>
			<ul id="all-playlists">
			';
			$childs = $page->children;
			getchilds($childs);
			echo '</ul>';

		}
		?>
		
		</div><!-- /responses -->




	</div><!-- /content -->

</div><!-- /row -->
	
	



</div><!-- /container -->
</body>
</html>