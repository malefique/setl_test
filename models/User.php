<?php

namespace models;

class User extends Model
{
    protected $table = 'users';

    protected $validationMap = [
        'login' => [
            'string', [5, 50], true
        ],
        'password' => [
            'string', [3, 50], true
        ]
    ];

    public function getOne(string $login, string $password)
    {
        try{
            $q = $this->db->prepare("SELECT `id`,`login` FROM `{$this->table}` WHERE `login` = ? AND `password` = ?");
            $q->execute([$login,$password]);
            if($q)
                return $q->fetch();
            else
                return false;
        } catch (\PDOException $e){
            throw new \Exception($e->getMessage());
        }
    }
}