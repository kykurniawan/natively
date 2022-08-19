<?php

namespace App\Models;

use App\Entities\User;
use Core\System\Model;

class UserModel extends Model
{
    public $table = "users";
    public $entity = User::class;
}
