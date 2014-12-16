<?php 
	if(isset($data->error)){
		echo $data->error;
	}
?>
<form method="post" action="#">
	<label for="fileTitle">Sichtbarer Titel:</label><input type="text" id="fileTitle" name="fileTitle"><br>
	<?php 
		foreach($data->files as $file){
			if($file !== "." && $file !== ".."){
				$fileName = explode(".", $file);
				echo "<input type=\"radio\" name=\"fileName\" id=\"".$fileName[0]."\" value=\"$fileName[0]\"><label for=\"".$fileName[0]."\">".$fileName[0]."</label><br>";
			}
		}	
	?>
	<input type="submit" value="Speichern">	
</form>