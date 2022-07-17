<?php

require_once("./init.php");

$route->action("home", function (Request $req, Response $res) {
    return $res->view("home", [
        "nama" => "Rizky",
        "kelas" => "8C REG PAGI BJM",
        "baseUrl" => $req->app->config->baseUrl
    ]);
});

$route->handle();
