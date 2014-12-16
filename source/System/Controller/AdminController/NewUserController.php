<?php

namespace Controller\AdminController;

class NewUserController extends LoggedInController {
	private $data;
	private $link;
	private $title;
		
	public function __construct() {
		parent::__construct ();
	}
	public function show() {
		// Change Structure!!!
		if ($_POST) {
			$this->saveUser();
		} else {
			// Call Daddy
			$this->link = "newUser";
			$this->title = "Hercules";
		}
		parent::output ( $this->link, $this->title, $this->data );
	}
	
	public function saveUser(){
		// Data? - OK
		$this->data = new \stdClass();
		$user = new \Core\User ();
		$this->data->error = "";
		$this->data->error.= $user->setAuthorName($_POST['userAuthorName']);
		$this->data->error.= $user->setUsername($_POST['userName']);
		$this->data->error.= $user->setPassword($_POST['userPassword']);
		$user->createHash();
			
		if($this->data->error === ""){
			\Repository\Factory::getRepUser()->save($user);
			// Call Daddy with success msg
			$this->link = "newUser_saved";
			$this->title = "Hercules";
			$this->data = "Erfolgreich gespeichert";
		} else {
			// Call Daddy - with err
			$this->link = "newUser";
			$this->title = "Hercules";
		}
	}
}