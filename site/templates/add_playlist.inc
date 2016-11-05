<?php

if(!isset($input->post['submit'])) {

?>

<form action="./" method="post" enctype="multipart/form-data">
				<p>
					<label for="playlist_title">
						playlist title
					</label>
					<input name="playlist_title" id="playlist_title" type="text">
       			</p>


				<p>
					<label for="playlist_image">
						background image
					</label>
					<input name="playlist_image" id="playlist_image" type="file">
       			</p>



				<input name="username" type="hidden" value="<?=$user->name;?>">

				<p>
					<input type="submit" value="add" name="submit">
				</p>
           
</form>


<?php
}

else {

// get post values
$title = $input->post['playlist_title'];

//sanitize post values
$title = $sanitizer->text($title);
$name = $sanitizer->pageName($title);


//create new page
$p = new Page();
$p->template = $templates->get("playlists-challenge");
if($page->title == 'admin')
{
	$p->parent = $pages->get("/playlists/");
}
else
{
	$p->parent = $page;
}
$p->title = $title;
$p->name = $name;
$p->save();


//get image/file
$path = $config->paths->assets;

if(strstr($_FILES['playlist_image']['type'], 'image')!==false) {
	$file = $path . '/' .$_FILES['playlist_image']['name'];

		if(move_uploaded_file($_FILES['playlist_image']['tmp_name'],$file)) {
			//adds file to assets -> page directory
			$p->background_image->add($file);
			//sets name of file to mp3 field
			$p->set('background_image',$_FILES['playlist_image']['name']);
			//save page
			$p->setOutputFormatting(false);
			$p->save();




			echo '
			<h2>your playlsit has been created</h2>

			<p>now how \'bout <a href="' . $p->url . '">adding some songs</a>...</p>


			';

		} 
		else 
		{ 
			echo 'something went wrong with your uploads. please try again.'; 
		}


}

}
?>