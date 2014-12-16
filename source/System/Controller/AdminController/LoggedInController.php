<?php
namespace Controller\AdminController;

abstract class LoggedInController extends BackendController{
	private $succeed = false;
	public function __construct(){
		if(!empty($_COOKIE['id']) && !empty($_COOKIE['hash'])){
			$user = \Repository\Factory::getRepUser()->getByCookieData($_COOKIE['id'], $_COOKIE['hash']);
		} else if(!empty($_POST['username']) && !empty($_POST['password'])){
			$user = \Repository\Factory::getRepUser()->getByPostData($_POST['username'], $_POST['password']);
		}
		
		if($user){
			$time = time() + 8640000;
			setcookie("id", $user->getId(), $time);
			setcookie("hash", $user->getHash(), $time);
			$this->succeed = true;
		} else {
			setcookie("id", "", time() - 3600);
			setcookie("hash", "", time() - 3600);
		}
	}
	public function output($templateName, $title,  $data = null){
		//Always keep in mind: USER is AVAILABLE
		$user = \Repository\Factory::getUser();
		include \Core\Config::getAppDir()."/admin/Template/_surrounding_admin_start.php";
		include \Core\Config::getAppDir()."/admin/Template/".$templateName.".php";
		include \Core\Config::getAppDir()."/admin/Template/_surrounding_admin_end.php";
	}
	
	public function isSucceed(){
		return $this->succeed;
	}
	
	// I'm Outa here....
	public function showError(){
		// call Daddy for Output
		parent::output("loginError", "Login Error - Hercules");
	}
}