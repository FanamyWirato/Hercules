<?php
namespace Controller\AdminController;

abstract class BackendController extends \Controller\Controller{
	public function output($templateName, $title,  $data = null){
		include \Core\Config::getAppDir()."/admin/Template/_surrounding_start.php";
		include \Core\Config::getAppDir()."/admin/Template/".$templateName.".php";
		include \Core\Config::getAppDir()."/admin/Template/_surrounding_end.php";
	}
}