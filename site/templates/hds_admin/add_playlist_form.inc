<form action="/mixtagon/admin/playlist-added" method="post" enctype="multipart/form-data" class="add-playlist-form">
<p>
	<label for="playlist_title">name your playlist:</label>
	<input type="text" name="playlist_title">
</p>

<p>
	<label for="playlist_body">any words?</label>
	<input type="text" name="playlist_body">
</p>


<p>
	<label for="file">add songs:</label>
	<input type="file" name="file[]" id="file" multiple /> 
</p>

<p>
	<input type="submit" name="submity" value="Submit" />
</p>
</form>

