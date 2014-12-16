<html>
	<head>
		<title><?php echo $title; ?></title>
		<script src="<?php echo "/js/tinymce.min.js"; ?>"></script>
		<script>
			tinymce.init({
				selector: "textarea",
				plugins: "textcolor",
				toolbar: "styleselect | undo redo | removeformat | bold italic underline | alignleft aligncenter alignright alignjustify  | bullist numlist outdent indent | link | print | fontselect fontsizeselect | forecolor"						
			});
		</script>
	</head>
<body>
	<h2>Hello <?php echo $user->getUsername();?> and Welcome to <a href="?">H.E.R.C.U.L.E.S.</a></h2>
	<h4>Your current author name: <?php echo $user->getAuthorName();?></h4>
	<table>
		<tr>
			<td><a href="?site=newPost">New Post</a></td><td><a href="?site=managePost">Manage Posts</a></td><td><a href="?site=newFile">New File</a></td><td><a href="?site=manageFile">Manage Files</a></td><td><a href="?site=newUser">New User</a></td>
			
		</tr>
	</table>
	<div id="content">