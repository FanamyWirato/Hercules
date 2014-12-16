<?php
namespace Controller;
abstract class Controller{
	public function __construct(){
		
	}
	
	public function output($templateName, $title,  $data = null){
		include \Core\Config::getAppDir()."/Template/_surrounding_start.php";
		include \Core\Config::getAppDir()."/Template/".$templateName.".php";
		include \Core\Config::getAppDir()."/Template/_surrounding_end.php";
	}
	abstract public function show();	
}