<?php 
	if(isset($data->error)){
		echo $data->error;
	}
?>
<form method="post" action="?site=managePost&edit=<?php echo $data->post->getID()?>">
	<label for="title">Titel: </label><input type="text" id="title" name="postTitle" value="<?php echo $data->post->getTitle()?>">
	<textarea name="postText"><?php echo $data->post->getText()?></textarea>
	<input type="submit" value="Speichern">	
</form>
	
