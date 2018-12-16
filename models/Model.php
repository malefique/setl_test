<?php

namespace models;

use PDO;

abstract class Model
{
    protected $table;
    protected $validationMap;
    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function __call($method, $parameters)
    {
        throw new Exception("Method {$method} does not exist");
    }

    public function getValidationMap()
    {
        return $this->validationMap;
    }
}