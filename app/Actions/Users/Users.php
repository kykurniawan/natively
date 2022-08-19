<?php

namespace App\Actions\Users;

use App\Models\UserModel;
use Core\System\Request;
use Core\System\Response;

class Users
{
    public $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel;
    }

    public function __invoke(Request $request, Response $response)
    {
        $users = $this->userModel->findAll();

        return $response->view([
            "header",
            "users/users",
            "footer",
        ], [
            "users" => $users
        ]);
    }
}
