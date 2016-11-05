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
					<li><a href="<?=$pages->get('/')->url;?>"><?=$pages->get('/')->title;?></a></li>

<!-- 					<?php $loggedurl = ($user->isLoggedin()) ? $config->urls->root . 'login/logout' : $config->urls->root . 'login'; ?>
					<?php $logged = ($user->isLoggedin()) ? 'logout' : 'login'; ?>
					<li><a href="<?=$loggedurl; ?>"><?=$logged;?></a></li>
 -->			
					<?php
					if($user->isLoggedin()) :
					?>
					<li><a href="<?=$pages->get('/admin/')->url;?>"><?=$pages->get('/admin/')->title;?></a></li>
					<li><a href="<?php echo $config->urls->root . 'login/logout'; ?>">logout</a></li>

					<?php else: ?>

					<li><a href="<?php echo $config->urls->root . 'login'; ?>">login</a></li>

					<?php endif; ?>

				</ul>
			</div>



			
		</div><!-- /#header -->
		

