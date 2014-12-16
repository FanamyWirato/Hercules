<?php
namespace Core;

class User{
	private $id;
	private $username;
	private $password;
	private $authorName;
	private $hash;
	
	public function __construct($dbo = null){
		if($dbo){
			$this->setAll($dbo);
		}
	}
	
	public function setAll($dbo){
		$this->id = $dbo->user_ID;
		$this->username = $dbo->name;
		$this->password = $dbo->pw;
		$this->authorName = $dbo->authorName;
		$this->hash = $dbo->hash;
	}
	
	public function getID(){
		return $this->id;
	}
	
	public function getUsername(){
		return $this->username;
	}
	// Compare the User PW with the Given Password (Post Entry)
	public function comparePw($postPW){
		# HASHING!!!!!!
		if($this->password == $postPW){
			return true;
		} else{
			return false;
		}
	}
	
	public function getPassword(){
		return $this->password;
	}
	
	public function getAuthorName(){
		return $this->authorName;
	}
	
	public function getHash(){
		return $this->hash;
	}
	public function setUsername($username){
		if(empty($username)){
			return "Kein Username angegeben<br>";
		}
		$this->username = $username;
	}
	public function setPassword($password){
		if(empty($password)){
			return "Kein Passwort angegeben<br>";
		}
		$this->password = $password;
	}
	public function setAuthorName($authorName){
		if(empty($authorName)){
			return "Kein Autoren Name angegeben<br>";
		}
		$this->authorName = $authorName;
	}
	public function createHash(){
		$this->hash = md5($this->username.time());
	}
}