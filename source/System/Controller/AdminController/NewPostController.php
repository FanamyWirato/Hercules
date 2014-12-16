<?php

namespace Controller\AdminController;

class NewPostController extends LoggedInController {
	private $data;
	private $link;
	private $title;
		
	public function __construct() {
		parent::__construct ();
	}
	public function show() {
		// Change Structure!!!
		if ($_POST) {
			$this->savePost();
		} else {
			// Call Daddy
			$this->link = "newPost";
			$this->title = "Hercules";
		}
		parent::output ( $this->link, $this->title, $this->data );
	}
	
	public function savePost(){
		// Data? - OK
		$this->data = new \stdClass();
		$post = new \Core\Post ();
		$this->data->error = "";
		$this->data->error.= $post->setTitle ( $_POST ['postTitle'] );
		$this->data->error.= $post->setText($_POST['postText']);
		$post->setDate(); //Now
		$post->setAuthor(\Repository\Factory::getUser()->getID());
			
		if($this->data->error === ""){
			\Repository\Factory::getRepPost()->save($post);
			// Call Daddy with success msg
			$this->link = "newPost_saved";
			$this->title = "Hercules";
			$this->data = "Erfolgreich gespeichert";
		} else {
			// Call Daddy - with err
			$this->link = "newPost";
			$this->title = "Hercules";
		}
	}
}