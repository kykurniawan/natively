<?php

namespace Core\System;

use Core\Database\DB;
use Exception;
use PDO;

class Model
{
    public $db;
    public $entity = "";
    public $table = "";
    public $primaryKey = "id";

    public function __construct()
    {
        $this->db = DB::connection();
        if(class_exists($this->entity) === false) {
            throw new Exception("Invalid entity class");
        }
        
        if($this->table =="") {
            throw new Exception("Please specify table name");
        }
    }

    public function  find($id)
    {
        $statement = $this->db->prepare("SELECT * FROM " . $this->table . " WHERE " . $this->primaryKey . "=?");
        $statement->bindParam(1, $id);
        $statement->execute();
        $result = $statement->fetchObject($this->entity);
        if (!$result) {
            return null;
        }
        return $result;
    }

    public function findAll()
    {
        $statement = $this->db->prepare("SELECT * FROM " . $this->table);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_CLASS, $this->entity);
        return $result;
    }

    public function insert($entity)
    {
        $publicProperties = get_object_vars($entity);
        $fields = array_keys($publicProperties);

        $placeholders = array_map(function ($field) {
            return ":" . $field;
        }, $fields);

        $query = "INSERT INTO " . $this->table . " ";
        $query .= "(" . implode(", ", $fields) . ") VALUES ";
        $query .= "(" . implode(", ", $placeholders) . ")";

        $statement = $this->db->prepare($query);
        foreach ($publicProperties as $field => $value) {
            $fieldPlaceHolder = ":" . $field;
            $statement->bindValue($fieldPlaceHolder, $value);
        }
        $statement->execute();

        return $this->find($this->db->lastInsertId());
    }

    public function update($entity)
    {
        $publicProperties = get_object_vars($entity);

        $id = $publicProperties[$this->primaryKey];
        unset($publicProperties[$this->primaryKey]);
        $sets = array_map(function ($set) {
            return $set . " = :" . $set;
        }, array_keys($publicProperties));

        $query = "UPDATE " . $this->table . " SET ";
        $query .= implode(", ", $sets) . " ";
        $query .= "WHERE " . $this->primaryKey . "= :" . $this->primaryKey;

        $statement = $this->db->prepare($query);
        foreach ($publicProperties as $field => $value) {
            $set = ":" . $field;
            $statement->bindValue($set, $value);
        }
        $primaryPlaceholder = ":" . $this->primaryKey;
        $statement->bindValue($primaryPlaceholder, $id);

        return $statement->execute();
    }

    public function delete($entity)
    {
        $publicProperties = get_object_vars($entity);
        $query = "DELETE FROM " . $this->table . " ";
        $query .= "WHERE " . $this->primaryKey . "= ?";
        $statement = $this->db->prepare($query);
        $statement->bindValue(1, $publicProperties[$this->primaryKey]);

        return $statement->execute();
    }
}
