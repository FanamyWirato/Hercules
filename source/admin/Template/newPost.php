<?php 
	if(isset($data->error)){
		echo $data->error;
	}
?>
<form method="post" action="#">
	<label for="title">Titel: </label><input type="text" id="title" name="postTitle" value="<?php if(!empty($_POST['postTitle'])){ echo $_POST['postTitle'];}?>">
	<textarea name="postText">
		<?php if(!empty($_POST['postText'])){ echo $_POST['postText'];}?>
	</textarea>
	<input type="submit" value="Speichern">	
</form>
	
