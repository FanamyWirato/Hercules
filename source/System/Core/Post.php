<?php
namespace Core;

class Post{
	private $id;
	private $title;
	private $date; //DateTime Object
	private $text;
	private $author; //User
	
	public function __construct($dbo = null){
		if($dbo){
			$this->setAll($dbo);
		}
	}
	
	public function setAll($dbo){
		$this->id = $dbo->post_ID;
		$this->title = $dbo->title;
		$this->date = new \DateTime($dbo->date);
		$this->text = $dbo->text;
		$this->author = $dbo->author;
	}
	
	public function getID(){
		return $this->id;
	}
	
	public function getTitle(){
		return $this->title;
	}
	
	public function getDate(){
		return $this->date;
	}
	
	public function getText(){
		return $this->text;
	}
	
	public function getAuthor(){
		return \Repository\Factory::getRepUser()->getById($this->author);
	}
	
	public function setTitle($title){
		if(empty($title)){
			return "Kein Titel angegeben<br>";
		}
		$this->title = $title;
	}
	
	/**
	 * 
	 * @param DateTime $date
	 * 
	 * If no data given: Date will be NOW
	 */
	public function setDate($date = null){
		if($date === null){
			$this->date = new \DateTime();
		} else {
			$this->date = $date;
		}		
	}
	public function setText($text){
		if(empty($text)){
			return "Kein Text angegeben<br>";
		}
		$this->text = $text;	
	}
	public function setAuthor($author){
		
		$this->author = $author;
	}
	
}