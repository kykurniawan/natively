<?php

namespace App\Actions;

use Core\System\Request;
use Core\System\Response;

class Home
{
    public function __invoke(Request $request, Response $response)
    {
        return $response->view([
            "header",
            "home",
            "footer",
        ]);
    }
}
