<?php
namespace Repository;

class RepositoryFile {
	/**
	 *
	 * @var \PDO
	 */
	private $cube;
	/**
	 *
	 * @var \Core\File[]
	 */
	private $fileList = array();
	
	/* Dependency Injection */
	public function __construct(\PDO $cube){
		$this->cube = $cube;
	}
	
	public function save(\Core\File $file){
		if($file->getID()){
			//Update
			$stmt = $this->cube->prepare("UPDATE files SET visibleTitle = :title, fileName = :name WHERE file_ID = :id");
			$stmt->bindValue(':title', $file->getVisibleTitle());
			$stmt->bindValue(':name', $file->getFileName());
			$stmt->bindValue(':id', $file->getID());
			$stmt->execute();
			
		} else {
			//Create
			$stmt = $this->cube->prepare("INSERT INTO files (visibleTitle, fileName, owner) VALUES (:title, :name, :owner);");
			$stmt->bindValue(':title', $file->getVisibleTitle());
			$stmt->bindValue(':name', $file->getFileName());
			$stmt->bindValue(':owner', $file->getOwner()->getID());
			$stmt->execute();
		}
	}
	
	public function delete($id){
		$stmt = $this->cube->prepare("DELETE FROM files WHERE file_ID = :id");
		$stmt->bindValue(':id', $id);
		$stmt->execute();	
	}
	public function getById($id){
		if(!empty($this->fileList[$id])){
			return $this->fileList[$id];
		} else {
			$stmt = $this->cube->prepare("SELECT * FROM files WHERE file_ID = :id");
			$stmt->bindValue(':id', $id);
			$stmt->execute();
			if($stmt->rowCount() == 0){
				return false;
			}
			$dbFile = $stmt->fetchObject();
			$this->fileList[$dbFile->file_ID] = new \Core\File($dbFile);
			return $this->fileList[$dbFile->file_ID];
		}
	}
	public function getAll(){
		$stmt = $this->cube->prepare("SELECT * FROM files ORDER BY visibleTitle");
		$stmt->execute();
		while ($file = $stmt->fetchObject()){
			if(empty($this->fileList[$file->file_ID])){
				$this->fileList[$file->file_ID] = new \Core\File($file);
			}
			yield $this->fileList[$file->file_ID];
		}
	}
}