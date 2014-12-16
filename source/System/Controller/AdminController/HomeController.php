<?php
namespace Controller\AdminController;
class HomeController extends BackendController{
	private $errorList = array();

	public function __construct(){

	}

	public function show(){
		//Call Daddy
		parent::output("home", "Hercules");
	}
}