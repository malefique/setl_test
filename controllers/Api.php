<?php

namespace controllers;

use models\Post;
use models\User;
use helpers\Validator;
use helpers\Database;
use helpers\Captcha;

class Api extends Controller
{
    public function posts(int $count, int $offset)
    {
        $post = new Post(Database::connect());
        $posts = $post->get(abs($count), abs($offset));
        echo json_encode(['errors' => [], 'data' => $posts]);
    }

    public function postsAdmin(int $count, int $offset)
    {
        $post = new Post(Database::connect());
        $posts = $post->getAdmin(abs($count), abs($offset));
        echo json_encode(['errors' => [], 'data' => $posts]);
    }

    public function postSend(array $data)
    {
        $post = new Post(Database::connect());
        $validation = new Validator($post->getValidationMap(), $data);
        $result = $validation->validate();
        if($result[0])
        {
            if(@$_SESSION['captcha'] === htmlspecialchars($_POST['captcha']))
            {
                $post->addOne(array_values($result[1]));
                unset($_SESSION['captcha']);
                echo json_encode(['errors' => [], 'data' => ['Message was added']]);
            }
            else
                echo json_encode(['errors' => ['captcha' => 'Incorrect text from image'], 'data' => []]);
        }
        else
            echo json_encode(['errors' => $result[1], 'data' => []]);
    }

    public function postShowHide($id)
    {
        $post = new Post(Database::connect());
        if($post->showOrHide(intval($id)))
            echo json_encode(['errors' => [], 'data' => ['Message was edited']]);
        else
            echo json_encode(['errors' => 'Smth went wrong', 'data' => []]);
    }

    public function postDelete($id)
    {
        $post = new Post(Database::connect());
        if($post->delete(intval($id)))
            echo json_encode(['errors' => [], 'data' => ['Message was deleted']]);
        else
            echo json_encode(['errors' => 'Smth went wrong', 'data' => []]);
    }

    public function login(array $data)
    {
        $user = new User(Database::connect());
        $validation = new Validator($user->getValidationMap(), $data);
        $result = $validation->validate();
        if($result[0])
        {
            $result[1]['password'] = md5($result[1]['password']);
            $info = $user->getOne(...array_values($result[1]));
            if($info) {
                $_SESSION['login'] = $info['login'];
                echo json_encode(['errors' => [], 'data' => ['Login successfull']]);
            }
            else{
                echo json_encode(['errors' => ['password' => 'Incorrect'], 'data' => []]);
            }
        }
        else
            echo json_encode(['errors' => $result[1], 'data' => []]);
    }

    public function logout()
    {
        unset($_SESSION['login']);
    }

    public function refreshCaptcha()
    {
        unset($_SESSION['captcha']);
    }
}