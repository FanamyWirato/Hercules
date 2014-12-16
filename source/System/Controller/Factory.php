<?php
namespace Controller;

final class Factory{
	protected static $ctrlHome = null;
	
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
	
	
	
	
}
