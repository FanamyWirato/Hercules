<?php
namespace Controller;
/*
 * Special Controller for AJAX Requests
 */
abstract class RequestController extends Controller{
	public function __construct(){
		
	}
	
	public function output($templateName, $title,  $data = null){
		include \Core\Config::getAppDir()."/Template/".$templateName.".php";
	}	
}