<?php

namespace models;

class Post extends Model
{
    protected $table = 'posts';

    protected $validationMap = [
        'author' => [
            'string', [5, 50], true
        ],
        'email' => [
            'email', [3, 50], true
        ],
        'subject' => [
            'string', [10, 200], true
        ],
        'message' => [
            'string', [10, 2000], true
        ]
    ];

    public function addOne(array $data)
    {
        try{
            $q = $this->db->prepare("INSERT INTO `{$this->table}` (`author`,`email`,`subject`,`message`,`created_at`,`updated_at`) VALUES(?, ?, ?, ?, NOW(), NOW());");
            $q->execute($data);
        } catch (\PDOException $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function delete(int $id)
    {
        try{
            return $this->db->query("DELETE FROM `{$this->table}` WHERE `id` = {$id};");
        } catch (\PDOException $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function showOrHide(int $id)
    {
        try{
            return $this->db->query("UPDATE `{$this->table}` SET `published` = FLOOR(ACOS(`published`)) WHERE `id` = {$id};");
        } catch (\PDOException $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function get(int $count, int $offset)
    {
        try{
            $results = $this->db->query("SELECT SQL_CALC_FOUND_ROWS `id`,`author`,`subject`,`message`,`created_at` FROM `{$this->table}` WHERE `published` = 1 ORDER BY `created_at` DESC LIMIT {$offset}, {$count}")->fetchAll();
            $count = $this->db->query("SELECT FOUND_ROWS()")->fetchColumn();
            return ['count' => $count, 'results' => $results];
        } catch (\PDOException $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function getAdmin(int $count, int $offset)
    {
        try{
            $results = $this->db->query("SELECT SQL_CALC_FOUND_ROWS `id`,`author`,`email`,`published`,`subject`,`message`,`created_at` FROM `{$this->table}` ORDER BY `published` ASC,`created_at` DESC LIMIT {$offset}, {$count}")->fetchAll();
            $count = $this->db->query("SELECT FOUND_ROWS()")->fetchColumn();
            return ['count' => $count, 'results' => $results];
        } catch (\PDOException $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function getOne(int $id)
    {
        try{
            $results = $this->db->query("SELECT `id`,`author`,`subject`,`message`,`created_at` FROM `{$this->table}` WHERE `published` = 1 AND `id` = {$id}")->fetch();
            return $results;
        } catch (\PDOException $e){
            throw new \Exception($e->getMessage());
        }
    }
}