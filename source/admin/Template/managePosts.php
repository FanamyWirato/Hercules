<?php 
	if(isset($data->msg)){
		echo $data->msg;
	}
?>
<table>
	<?php 
		foreach($data->posts as $post){
			$post instanceof \Core\Post;;
			echo "<tr>
					<td>".$post->getTitle()."</td>
					<td>".$post->getDate()->format("d.m.Y")."</td>
					<td>".$post->getAuthor()->getUsername()."</td>
					<td><a href=\"?site=managePost&del=".$post->getID()."\">Delete</a></td>
					<td><a href=\"?site=managePost&edit=".$post->getID()."\">Edit</a></td>
				</tr>";			
		}
	?>
</table>