<?php

use Core\System\App;
use Core\System\Config;

require_once("../vendor/autoload.php");

// Configuration
$config = new Config;
$config->appName = "Natively";
$config->baseURL = "http://localhost/natively/public/";

// Create app instance
$app = new App($config);

// Run our app
$app->run();
