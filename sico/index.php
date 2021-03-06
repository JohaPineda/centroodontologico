<?php
error_reporting(0);
define('EXECG__', 20);
define("DS", DIRECTORY_SEPARATOR);
define("SL", "/");
define("BASE_NAME", dirname(__FILE__));
define("CONTROLLERS", BASE_NAME . DS . "controllers");
define("VIEWS", BASE_NAME . DS . "views");
define("MODELS", BASE_NAME . DS . "models");
define("LIBS", BASE_NAME . DS . "libs");
define("INCLUDES", BASE_NAME . DS . "includes");
define("MESSAGES", BASE_NAME . DS . "messages");
define("STYLES", "css");
define("JAVASCRIPTS", "scripts");
define("IMAGES", "images");
define("LOG", BASE_NAME . DS . "developer.log");
define("LOGDB", BASE_NAME . DS . "errors_db.log");
define("LOGUSER", BASE_NAME . DS . "user_login.log");
define("MENU", VIEWS  .DS."menu.php");
define("TEMPLATE", VIEWS  .DS."template.php");
require (LIBS . DS . 'FrontController.php');
FrontController::run();
?>