<?php

use Core\App;

define("SLASH", DIRECTORY_SEPARATOR);
define("ROOT_PATH", __DIR__);
define("APP_PATH", ROOT_PATH . "/src/App");
define("VIEW_PATH", ROOT_PATH . "/src/Views");


require_once("./src/autoload.php");
require_once("./src/Helpers/url.php");

$app = new App;

$app->setBaseURL("http://localhost/natively/");

$app->run();
