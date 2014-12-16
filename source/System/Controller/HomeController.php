<?php
namespace Controller;
class HomeController extends Controller{
	private $errorList = array();

	public function __construct(){

	}

	public function show(){
		//Collect Data Here
		$posts = \Repository\Factory::getRepPost()->getAll();
		$files = \Repository\Factory::getRepFile()->getAll();
		//Call Daddy
		parent::output("home", "Hercules", array('posts' => $posts, 'files' => $files));
	}
}