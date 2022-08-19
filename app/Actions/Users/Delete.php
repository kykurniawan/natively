<?php

namespace App\Actions\Users;

use App\Entities\User;
use App\Models\UserModel;
use Core\System\Request;
use Core\System\Response;

class Delete
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

            $id = $request->post("id");

            $user = $this->userModel->find($id);

            if ($user) {
                $this->userModel->delete($user);
                return $response->redirect("users");
            }

            return $response->redirect("users");
        }
    }
}
