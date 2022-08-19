<?php

namespace App;

use App\Actions\About;
use App\Actions\Home;
use App\Actions\Users\Delete;
use App\Actions\Users\Edit;
use App\Actions\Users\Insert;
use App\Actions\Users\Users;
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

        $this->action("users", Users::class);
        $this->action("users.insert", Insert::class);
        $this->action("users.delete", Delete::class);
        $this->action("users.edit", Edit::class);
    }
}
