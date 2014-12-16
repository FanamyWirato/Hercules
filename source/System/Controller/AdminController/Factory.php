<?php
namespace Controller\AdminController;

final class Factory{
	protected static $ctrlHome = null;
	protected static $ctrlIntern = null;
	protected static $ctrlNewPost = null;
	protected static $ctrlManagePost = null;
	protected static $ctrlNewFile = null;
	protected static $ctrlManageFile = null;
	protected static $ctrlNewUser = null;
	
	protected function __construct(){
		// Thou shalt not construct that which is unconstructable!
	}
	
	protected function __clone(){
		// Me not like clones! Me smash clones!
	}
	
	/**
	 * 
	 * @return \Controller\HomeController
	 */
	public static function getCtrlHome(){
		if(!isset(self::$ctrlHome)){
			self::$ctrlHome = new HomeController();
		}
		return self::$ctrlHome;
	}	
	
	public static function getCtrlIntern(){
		if(!isset(self::$ctrlIntern)){
			self::$ctrlIntern = new InternController();
		}
		return self::$ctrlIntern;
	}
	
	public static function getCtrlNewPost(){
		if(!isset(self::$ctrlNewPost)){
			self::$ctrlNewPost = new NewPostController();
		}
		return self::$ctrlNewPost;
	}
	
	public static function getCtrlManagePost(){
		if(!isset(self::$ctrlManagePost)){
			self::$ctrlManagePost = new ManagePostController();
		}
		return self::$ctrlManagePost;
	}
	
	public static function getCtrlNewFile(){
		if(!isset(self::$ctrlNewFile)){
			self::$ctrlNewFile = new NewFileController();
		}
		return self::$ctrlNewFile;
	}
	
	public static function getCtrlManageFile(){
		if(!isset(self::$ctrlManageFile)){
			self::$ctrlManageFile = new ManageFileController();
		}
		return self::$ctrlManageFile;
	}
	
	public static function getCtrlNewUser(){
		if(!isset(self::$ctrlNewUser)){
			self::$ctrlNewUser = new NewUserController();
		}
		return self::$ctrlNewUser;
	}
}
