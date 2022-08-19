<?php

namespace App;

use Core\Database\DB;
use Core\Database\Migration as DatabaseMigration;

class Migration implements DatabaseMigration
{
    private $db;

    public function __construct()
    {
        $this->db = DB::connection();
    }
    public function up()
    {
        $this->usersTable();
        $this->postsTable();
    }

    public function down()
    {
        $statement = $this->db->prepare("DROP TABLE IF EXISTS users");
        $statement->execute();
        $statement = $this->db->prepare("DROP TABLE IF EXISTS posts");
        $statement->execute();
    }


    private function usersTable()
    {
        $query = "CREATE TABLE IF NOT EXISTS users (id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT, name VARCHAR(128) NOT NULL, email VARCHAR(128) NOT NULL, password VARCHAR(128) NOT NULL, UNIQUE (email)) ENGINE = InnoDB";

        $statement = $this->db->prepare($query);

        $statement->execute();
    }

    private function postsTable()
    {
        $query = "CREATE TABLE IF NOT EXISTS posts (id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT, user_id INTEGER NOT NULL, title VARCHAR(128) NOT NULL, body TEXT NOT NULL) ENGINE = InnoDB";

        $statement = $this->db->prepare($query);

        $statement->execute();
    }
}
