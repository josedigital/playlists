<?php

if(!isset($input->post['submit'])) {

?>

<div id="add-songs-form">

	

	<form action="./" method="post" enctype="multipart/form-data" class="add-songs-form">
	<h3>add some songs, homie</h3>
	<p>
		<label for="file">upload songs:</label>
			<input type="file" name="file[]" id="file" multiple /> 
	</p>

	<p>
		<input type="submit" name="submit" value="Submit" />
	</p>

</form>

</div>



<?php
}

else {

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
			echo '<p>your files have been uploaded.</p>';

		} else 
		{ 
			echo 'something went wrong with your uploads. please try again.'; 
		}
			
	}
}




}
?>