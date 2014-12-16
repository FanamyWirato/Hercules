<?php

namespace Controller\AdminController;

class NewFileController extends LoggedInController {
	private $data;
	private $link;
	private $title;
	public function __construct() {
		parent::__construct ();
		$this->data = new \stdClass();
	}
	public function show() {
		if ($_POST) {
			$this->saveFile();
		} else {
			$this->data->files = \Core\File::getFilesFromDir();				
			$this->link = "newFile";
			$this->title = "Hercules";			
		}
		parent::output ( $this->link, $this->title, $this->data);
	}
	public function saveFile(){
		// Data? - OK
		$file = new \Core\File ();
		$this->data->error = "";
		$this->data->error.= $file->setVisibleTitle ( $_POST ['fileTitle'] );
		$this->data->error.= $file->setFileName(isset($_POST['fileName']) ? $_POST['fileName'] : null);
		$file->setOwner(\Repository\Factory::getUser()->getID());
		
		if($this->data->error === ""){
			\Repository\Factory::getRepFile()->save($file);
			$this->data = "Erfolgreich gespeichert";
			$this->link = "newFile_saved";
			$this->title = "Hercules";
		} else {
			$this->data->files = \Core\File::getFilesFromDir();
			$this->link = "newFile";
			$this->title = "Hercules";
		}	
	}
}