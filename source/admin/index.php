<?php
	session_start();
	ini_set('display_errors', 'on');
	error_reporting(-1);
	include("../System/Core/Config.php");
	if(isset($_GET['site'])){
		$site = ucfirst($_GET['site']);
		if(method_exists('\Controller\AdminController\Factory', 'getCtrl'.$site)){
			$cntrl = \Controller\AdminController\Factory::{'getCtrl'.$site}();
			if($cntrl instanceof Controller\AdminController\LoggedInController){
				if($cntrl->isSucceed()){
					$cntrl->show();
				} else {
					$cntrl->showError();
				}
			} else {
				$cntrl->show();
			}
			
		} else{
			\Controller\AdminController\Factory::getCtrlHome()->show();
		}
	} else {
		if(isset($_COOKIE['id']) || isset($_POST['username'])){
			$cntrl = \Controller\AdminController\Factory::getCtrlIntern();
			if($cntrl->isSucceed()){
				$cntrl->show();
			} else {
				$cntrl->showError();
			}
		} else {
			\Controller\AdminController\Factory::getCtrlHome()->show();
		}		
	}