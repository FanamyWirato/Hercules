<?php
namespace Repository;

final class Factory{
	protected static $instance = null;
	protected static $user = null;
	protected static $repPost = null;
	protected static $repUser = null;
	protected static $repFile = null;

	protected function __construct(){
		// Thou shalt not construct that which is unconstructable!
	}

	protected function __clone(){
		// Me not like clones! Me smash clones!
	}

	public static function getInstance(){
		if(!isset(self::$instance)){
			$server = "localhost";
			$user = "root";
			$password = "antschi";
			$database = "hercules";
			self::$instance = new \PDO('mysql:host=' . $server . ';dbname=' . $database . ';charset=utf8;', $user, $password);
			self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}
		return self::$instance;
	}

	/**
	 *
	 * @return \Repository\RepositoryPost
	 */
	public static function getRepPost(){
		if(!isset(self::$repPost)){
			self::$repPost = new RepositoryPost(self::getInstance());
		}
		return self::$repPost;
	}
	/**
	 * 
	 * @return \Repository\RepositoryUser
	 */
	public static function getRepUser(){
		if(!isset(self::$repUser)){
			self::$repUser = new RepositoryUser(self::getInstance());
		}
		return self::$repUser;
	}
	/**
	 * 
	 * @return \Repository\RepositoryFile
	 */
	public static function getRepFile(){
		if(!isset(self::$repFile)){
			self::$repFile = new RepositoryFile(self::getInstance());
		}
		return self::$repFile;
	}
	
	/**
	 * 
	 * @param \Core\User $user
	 */
	public static function setUser($user){
		self::$user = $user;
	}
	
	/**
	 * @return \Core\User
	 */
	public static function getUser(){
		return self::$user;
	}
}

?>