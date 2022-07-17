<?php

require_once("./Libs/Flash.php");

require_once("./App/Constant.php");
require_once("./App/App.php");
require_once("./App/Request.php");
require_once("./App/Response.php");
require_once("./App/Config.php");
require_once("./App/Route.php");


require_once("./Helpers/url.php");

$config = new Config();

$app = new App($config);

$route = new Route($app);
