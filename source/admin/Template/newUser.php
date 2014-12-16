<?php 
	if(isset($data->error)){
		echo $data->error;
	}
?>
<form method="post" action="#">
	<label for="username">Username: </label><input type="text" id="username" name="userName" value="<?php if(!empty($_POST['userName'])){ echo $_POST['userName'];}?>"><br>
	<label for="authorname">Autor Name:</label><input type="text" id="authorname" name="userAuthorName" value="<?php if(!empty($_POST['userAuthorName'])){ echo $_POST['userAuthorName'];}?>"><br>
	<label for="password">Passwort: </label><input type="password" id="password" name="userPassword" value="<?php if(!empty($_POST['userPassword'])){ echo $_POST['userPassword'];}?>"><br>
	<input type="submit" value="Speichern">	
</form>
	
