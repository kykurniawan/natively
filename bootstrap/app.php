<?php

use Core\System\App;
use Core\System\Config;

$config = new Config;

$config->appName = "Natively";
$config->baseURL = "http://localhost/natively/public/";
$config->dbHost = "127.0.0.1";
$config->dbName = "natively";
$config->dbUser = "root";
$config->dbPass = "root";

$app = new App($config);

return $app;
