<?php 
	if(isset($data->error)){
		echo $data->error;
	}
?>
<form method="post" action="?site=manageFile&edit=<?php echo $data->file->getID()?>">
	<label for="fileTitle">Sichtbarer Titel:</label><input type="text" id="fileTitle" name="fileTitle" value="<?php echo $data->file->getVisibleTitle();?>"><br>
	<?php 
		foreach($data->files as $file){
			if($file !== "." && $file !== ".."){
				$fileName = explode(".", $file);
				if($fileName[0] == $data->file->getFileName()){
					echo "<input type=\"radio\" name=\"fileName\" id=\"".$fileName[0]."\" value=\"$fileName[0]\" checked=\"checked\"><label for=\"".$fileName[0]."\">".$fileName[0]."</label><br>";
				} else {
					echo "<input type=\"radio\" name=\"fileName\" id=\"".$fileName[0]."\" value=\"$fileName[0]\"><label for=\"".$fileName[0]."\">".$fileName[0]."</label><br>";
				}
			}
		}	
	?>
	<input type="submit" value="Speichern">	
</form>