<?php

namespace App;

use Core\Request;
use Core\Response;
use Core\Route as CoreRoute;

class Route extends CoreRoute
{
    public function boot()
    {
        $this->setDefaultAction("home");
        $this->setActionKey("action");
    }

    public function register()
    {
        $this->action("home", function (Request $request, Response $response) {
            $response->view("home");
        });

        $this->action("about", function (Request $request, Response $response) {
            $response->view("about");
        });
    }
}
