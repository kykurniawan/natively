<?php

namespace App\Actions;

use Core\System\Request;
use Core\System\Response;

class About
{
    public function __invoke(Request $request, Response $response)
    {
        return $response->view([
            "header",
            "about",
            "footer",
        ]);
    }
}
