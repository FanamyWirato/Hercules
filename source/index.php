<?php
error_reporting(-1);
include("System/Core/Config.php");
$controller = \Controller\Factory::getCtrlHome();
$controller->show();