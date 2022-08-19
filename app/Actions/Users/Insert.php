<?php

namespace App\Actions\Users;

use App\Entities\User;
use App\Models\UserModel;
use Core\System\Request;
use Core\System\Response;

class Insert
{
    public $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel;
    }

    public function __invoke(Request $request, Response $response)
    {
        if ($request->isPost() === false) {
            return $response->redirect("users");
        }

        if ($request->isPost()) {
            $user = new User;
            $user->name = $request->post("name");
            $user->email = $request->post("email");
            $user->password = password_hash($request->post("password"), PASSWORD_DEFAULT);

            $this->userModel->insert($user);

            return $response->redirect("users");
        }
    }
}
