<?php
namespace Core;

class File{
	private $id;
	private $visibleTitle;
	private $fileName;
	private $owner;
	
	public function __construct($dbo = null){
		if($dbo){
			$this->setAll($dbo);
		}
	}
	
	public function setAll($dbo){
		$this->id = $dbo->file_ID;
		$this->visibleTitle = $dbo->visibleTitle;
		$this->fileName = $dbo->fileName;
		$this->owner = $dbo->owner;
	}
	
	public function getID(){
		return $this->id;
	}
	public function getVisibleTitle(){
		return $this->visibleTitle;
	}
	public function getFileName(){
		return $this->fileName;
	}
	public function getOwner(){
		return \Repository\Factory::getRepUser()->getById($this->owner);
	}
	
	public function setVisibleTitle($visibleTitle){
		if(empty($visibleTitle)){
			return "Kein Datei-Titel angegeben<br>";
		}
		$this->visibleTitle = $visibleTitle;
	}
	public function setFileName($fileName){
		if(!file_exists(\Core\Config::getAppDir()."/files/".$fileName.".pdf")){
			return "Datei konnte nicht gefunden werden<br>";
		}
		$this->fileName = $fileName;
	}
	public function setOwner($owner){
		$this->owner = $owner;
	}
	
	public static function getFilesFromDir(){
		if ($handle = opendir(\Core\Config::getAppDir()."/files")) {
			while (false !== ($file = readdir($handle))) {
				yield $file;
			}
			closedir($handle);
		}
	}
}