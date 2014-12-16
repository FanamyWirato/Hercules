<?php

namespace Controller\AdminController;

class ManageFileController extends LoggedInController {
	private $data;
	private $link;
	private $title;
	public function __construct() {
		parent::__construct ();
		$this->data = new \stdClass();
	}
	public function show() {
		if(!empty($_GET['del'])){
			$this->deleteFile($_GET['del']);
		}
		if(!empty($_GET['edit'])){
			$this->editFile($_GET['edit']);
		} else {
			$this->data->files = \Repository\Factory::getRepFile()->getAll();
			$this->link = "manageFiles";
			$this->title = "Hercules";
		}
		parent::output($this->link, $this->title, $this->data);
	}
	
	public function deleteFile($id){
		\Repository\Factory::getRepFile()->delete($id);
		$this->data->msg = "Dateiverknüpfung erfolgreich gelöscht";
	}
	
	public function editFile($id){
		$file = \Repository\Factory::getRepFile()->getById($id);
		if($_POST){
			$this->data->error = "";
			$this->data->error.= $file->setVisibleTitle ( $_POST ['fileTitle'] );
			$this->data->error.= $file->setFileName(isset($_POST['fileName']) ? $_POST['fileName'] : null);
			if($this->data->error === ""){
				\Repository\Factory::getRepFile()->save($file);
				$this->data->files = \Repository\Factory::getRepFile()->getAll();
				$this->data->msg = "Dateiverknüpfung erfolgreich editiert";
				$this->link = "manageFiles";
				$this->title = "Hercules";
			} else {
				$this->data->file = $file;
				$this->data->files = \Core\File::getFilesFromDir();
				$this->link = "editFile";
				$this->title = "Hercules";
			}
		} else {
			$this->data->file = $file;
			$this->data->files = \Core\File::getFilesFromDir();
			$this->link = "editFile";
			$this->title = "Hercules";
		}
	}
}