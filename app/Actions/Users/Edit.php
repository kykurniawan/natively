<?php

namespace App\Actions\Users;

use App\Entities\User;
use App\Models\UserModel;
use Core\System\Request;
use Core\System\Response;

class Edit
{
    public $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel;
    }

    public function __invoke(Request $request, Response $response)
    {
        $id = $request->get("id");

        $user = $this->userModel->find($id);

        if (!$user) {
            $response->redirect("users");
        }

        if ($request->isGet()) {
            return $response->view([
                "header",
                "users/edit",
                "footer"
            ], [
                "user" => $user,
            ]);
        }

        if ($request->isPost()) {
            $user->name = $request->post("name");
            $user->email = $request->post("email");
            if ($request->post("password")) {
                $user->password = password_hash($request->post("password"), PASSWORD_DEFAULT);
            }

            $this->userModel->update($user);

            return $response->redirect("users");
        }
    }
}
