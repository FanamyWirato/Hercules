<?php
namespace Controller\AdminController;
class InternController extends LoggedInController{
	public function __construct(){
		parent::__construct();
	}
	public function show(){
		//Call Daddy
		parent::output("intern", "Hercules");
	}
}