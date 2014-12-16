<?php 
	if(isset($data->msg)){
		echo $data->msg;
	}
?>
<table>
	<?php 
		foreach($data->files as $file){
			$file instanceof \Core\File;;
			echo "<tr>
					<td>".$file->getVisibleTitle()."</td>
					<td>".$file->getFileName()."</td>
					<td>".$file->getOwner()->getUsername()."</td>
					<td><a href=\"?site=manageFile&del=".$file->getID()."\">Delete</a></td>
					<td><a href=\"?site=manageFile&edit=".$file->getID()."\">Edit</a></td>
				</tr>";			
		}
	?>
</table>