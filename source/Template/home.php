<?php 
	foreach($data['posts'] as $post){
		$post instanceof \Core\Post;;
		$authorName = $post->getAuthor() === NULL ? "Unbekannt" : $post->getAuthor()->getAuthorName(); 
		echo $post->getTitle().$authorName."<br>".$post->getText()."<br><br>";
	}
?>
<br>
<?php 
	foreach($data['files'] as $file){
		$file instanceof \Core\File;;
		echo "<a href=\"/files/".$file->getFileName().".pdf\" target=\"_blank\">".$file->getVisibleTitle()."</a><br>";
	}
?>