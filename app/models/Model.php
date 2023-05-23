<?php

namespace App\Model;

use PDO;

abstract class Model
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public static function getAll($connect, $table)
    {
        $select = "SELECT * FROM $table";
        $query = $connect->prepare($select);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
}