<?php 

/**
 * Page template
 *
 */

include("hds_admin/admin_head.inc"); 

?>


		<div class="row">

			<div class="sixcol">
				<h2>user admin</h2>

				<?php
					#echo $user->isLoggedin();
					if($user->isLoggedin())
					{
						include('add_playlist.inc');
					}
					else
					{
						$session->redirect($config->urls->root . 'login');
					}


				?>
			</div><!-- /6 -->




			<div class="sixcol last">

				<h2>your playlists</h2>
				<ul>
				<?php
				if($user->isLoggedin())
				{
					$playlists = $pages->find('template=playlists|playlists-challenge');
					//remove first page (parent playlist page) from page array
					$playlists = $playlists->slice(1);
					foreach($playlists as $playlist) {
						if($playlist->createdUser->name == $user->name)
						{
							echo '<li><a href="' . $playlist->url . '">' . $playlist->title . '</a></li>';
						}
					}
				}
				?>
				</ul>




				<h2>latest playlists</h2>
				<ul>
				<?php
				if($user->isLoggedin())
				{
					$playlists = $pages->find('template=playlists|playlists-challenge, limit=11');
					//remove first page (parent playlist page) from page array
					$playlists = $playlists->slice(1);
					foreach($playlists as $playlist) {
						echo '<li><a href="' . $playlist->url . '">' . $playlist->title . '</a></li>';
					}
				}
				?>



			</div><!-- /6	 -->


		</div><!-- /row -->

















</div><!-- /container#main -->



<?php

include("hds_admin/admin_foot.inc"); 