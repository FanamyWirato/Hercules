<?php

namespace Controller\AdminController;

class ManagePostController extends LoggedInController {
	private $data;
	public function __construct() {
		parent::__construct ();
		$this->data = new \stdClass();
	}
	public function show() {
		if(!empty($_GET['del'])){
			$this->deleteUser($_GET['del']);
		}
		if(!empty($_GET['edit'])){
			$this->editUser($_GET['edit']);
		} else {
			$this->data->posts = \Repository\Factory::getRepUser()->getAll();
			$this->link = "managePosts";
			$this->title = "Hercules";
		}
		parent::output($this->link, $this->title, $this->data);
	}
	
	public function deletePost($id){
		\Repository\Factory::getRepPost()->delete($id);
		$this->data->msg = "Beitrag erfolgreich gelöscht";
	}
	
	public function editPost($id){
		$post = \Repository\Factory::getRepPost()->getById($id);
		if($_POST){
			$this->data->error = "";
			$this->data->error.= $post->setTitle($_POST['postTitle']);
			$this->data->error.= $post->setText($_POST['postText']);
			if($this->data->error === ""){
				\Repository\Factory::getRepPost()->save($post);
				$this->data->posts = \Repository\Factory::getRepPost()->getAll();
				$this->data->msg = "Beitrag erfolgreich editiert";
				$this->link = "managePosts";
				$this->title = "Hercules";					
			} else {
				$this->data->post = $post;
				$this->link = "editPost";
				$this->title = "Hercules";
			}
		} else {
			$this->data->post = $post;
			$this->link = "editPost";
			$this->title = "Hercules";
		}
	}
}