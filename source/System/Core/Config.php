<?php
namespace Core;

final class Config{
	const PEPPER = "?!awesom36e203173Dez6e5mb3er2Cav7alcan3d5oIs2";

	public static function getAppDir()
	{
		return dirname(dirname(__DIR__));
	}
}
date_default_timezone_set('Europe/Vienna');
//autoloader
spl_autoload_register(function($className){
	include Config::getAppDir().'/System/' . str_replace("\\", DIRECTORY_SEPARATOR, $className) . ".php";
});