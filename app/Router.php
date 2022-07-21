<?php

namespace App;

use App\Actions\About;
use App\Actions\Home;
use Core\System\Router as SystemRouter;

class Router extends SystemRouter
{
    public function setUp()
    {
        // To be implemented latter
    }

    public function register()
    {
        $this->action("home", Home::class);
        $this->action("about", About::class);
    }
}
